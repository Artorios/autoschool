<?php

namespace App\Services\Settings;

/**
 * Interface SettingsInterface
 * @package App\Services\Settings
 */
interface SettingsInterface
{
    /**
     * @param string $key
     * @param string $default
     *
     * @return mixed
     */
    public function get(string $key, $default = '');

    /**
     * @param string $key
     * @param array  $value
     *
     * @return mixed
     */
    public function set(string $key, array $value);

    /**
     * @return mixed
     */
    public function all();
}