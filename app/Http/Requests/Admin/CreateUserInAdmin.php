<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserInAdmin extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'role' => Rule::in(['admin', 'autoschool', 'investor', 'user']),
            'last_name' => 'required|string|min:2',
            'second_name' => 'nullable|string',
            'phone' => 'required|numeric|min:8',
            'city_id' => 'required',
            'password' => 'required|min:8',
            'license' => Rule::in(['A', 'B', 'C']),

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
            'email.unique' => 'Пользователь с такой почтой существует',
            'role.rule' => 'Выберите роль',
            'last_name.required' => 'Введите фамилию',
            'last_name.string' => 'Должна быть строка',
            'last_name.min' => 'Должно быть больше 2-х символов',
            'second_name.string' => 'Должна быть строка',
            'phone.required' => 'Введите номер телефона',
            'phone.numeric' => 'Неверный ввод',
            'phone.min' => 'Должно быть больше 8-ми символов',
            'password.required' => 'Введите пароль',
            'password.min' => 'Должно быть больше 8-ми символов',
            'license.rule' => 'Выберите категорию',
            'city_id.required' => 'Выберите город',

        ];
    }
}
