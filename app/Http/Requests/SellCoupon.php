<?php

namespace App\Http\Requests;

use App\Models\Training\School\AutoSchool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class SellCoupon
 * @package App\Http\Requests
 */
class SellCoupon extends FormRequest
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
            'comment_director' => 'required|string|min:5'

        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'id.required' => 'Выберите свободный купон.',
            'comment_director.required' => 'Введите комментарий.',
            'comment_director.min' => 'Комментарий должен иметь больше 5 символов.',
        ];
    }

    /**
     * @inheritdoc
     */
    public function prepareForValidation()
    {
    }

}