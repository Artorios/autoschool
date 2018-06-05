<?php

namespace App\Http\Requests\Investor;

use Illuminate\Foundation\Http\FormRequest;

class SellCouponRequest extends FormRequest
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
            'id' => 'required|array',
            'comment_investor' => 'required|string|min:5'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'id.required' => 'Выберите свободный купон.',
            'comment_investor.required' => 'Введите комментарий.',
            'comment_investor.min' => 'Комментарий должен иметь больше 5 символов.',
        ];
    }
}
