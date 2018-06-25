<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserInAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => ['required', 'email'],
            'role' => ['required', Rule::in(['admin', 'autoschool', 'investor', 'user'])],
            'last_name' => 'required|string',
            'second_name' => 'nullable|string',
            'phone' => 'required|numeric|min:8',
            'auto_school_group_id' => 'nullable|integer',
            'city_id' => 'required',
            'password' => 'nullable|min:8',
            'license' => ['required', Rule::in(['A', 'B', 'C'])],
            'central' => 'nullable|integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [

            'name.required' => 'Введите имя',
            'name.string' => 'Должна быть строка',
            'name.min' => 'Должно быть больше 3-х символов',
            'email.required' => 'Введите email',
            'email.email' => 'Неверный ввод',
            'role.required' => 'Выберите роль',
            'last_name.required' => 'Введите фамилию',
            'last_name.string' => 'Должна быть строка',
            'second_name.string' => 'Должна быть строка',
            'phone.required' => 'Введите номер телефона',
            'phone.numeric' => 'Неверный ввод',
            'central.numeric' => 'Выберите центральный филиал',
            'phone.min' => 'Должно быть больше 8-ми символов',
            'city_id.required' => 'Выберите город',
            'license.rule' => 'Выберите категорию',
            'license.required' => 'Выберите категорию',
            'password.required' => 'Введите пароль',
            'password.min' => 'Должно быть больше 8-ми символов',



        ];
    }

}
