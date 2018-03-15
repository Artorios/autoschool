<?php

namespace App\Services\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

/**
 * Class Settings
 * @package App\Services\Settings
 */
class Settings implements SettingsInterface
{
    /**
     * @var Setting
     */
    protected $settings;

    /**
     * Settings constructor.
     */
    public function __construct()
    {
        $this->settings = new Setting();
    }

    /**
     * @return mixed|void
     */
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param string $key
     * @param string $default
     * @param int    $for_user
     *
     * @return string
     * @throws SettingsException
     */
    public function get(string $key, $default = '', $for_user = 0)
    {
        if ($for_user && \Auth::check()) {
            $key = $key . '|' . \Auth::id();
        }

        $setting = $this->settings->where('key', $key)->first();

        if ($setting) {
            return $setting->value;
        } else if ($default !== '') {
            return $default;
        } else {
            throw new SettingsException('Ключ не найден, значение по дефолту отсутствует');
        }
    }

    /**
     * @param string $key
     * @param array  $value
     * @param int    $for_user
     *
     * @return mixed
     * @throws SettingsException
     */
    public function set(string $key, array $value, $for_user = 0)
    {
        $v = Validator::make($value, [
            'value' => 'required',
            'name'  => 'sometimes|string'
        ]);

        if (count($v->errors())) {
            throw new SettingsException('Поля не заполнены');
        }

        if ( ! $value['name']) {
            $value['name'] = $key;
        }

        $value['key'] = $key;

        if ($for_user && \Auth::check()) {
            $value['key'] = $key . '|' . \Auth::id();
        } else {
            throw new SettingsException('Не удалось найти пользователя');
        }

        //dd($value);

        if ($this->settings->updateOrCreate(['key' => $value['key']], $value)) {
            return $value['value'];
        } else {
            throw new SettingsException('Не удалось сохранить');
        }

    }
}

/**
 * Class SettingsException
 * @package App\Services\Settings
 */
class SettingsException extends \ErrorException {}