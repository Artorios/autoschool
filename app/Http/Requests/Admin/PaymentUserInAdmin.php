<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentUserInAdmin extends FormRequest
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
            'payment_option' => 'required|string',
            'number_contract' => 'required|string',
            'amount' => 'required|integer',
            'auto_school_id' => 'required|integer',
            'user_id' => 'required|integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'payment_option.required' => 'Выберите тип оплаты.',
            'payment_option.string' => 'Тип оплаты - должна быть строка.',
            'number_contract.required' => 'Введите номер договора.',
            'number_contract.string' => 'Номер договора - должна быть строка.',
            'amount.required' => 'Введите сумму оплаты.',
            'amount.integer' => 'Сумма оплаты - должно быть число.',
            'auto_school_id.required' => 'Выберите автошколу.',
            'auto_school_id.integer' => 'Системная ошыбка.',
            'user_id.required' => 'Системная ошыбка.',
            'user_id.integer' => 'Системная ошыбка.',
        ];
    }
}
