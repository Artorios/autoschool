<?php

namespace App\Http\Requests\Investor;

use App\Models\Training\School\AutoSchool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class SellCoupon
 * @package App\Http\Requests
 */
class SellInvestorCoupon extends FormRequest
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
            'id' => 'required|array|unique:school_fees,coupon_id',
            'comment_investor' => 'required|min:20'

        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'id.required' => 'Выберите купон.',
            'id.unique' => 'Выберите ещё не выплаченые купоны.',
            'comment_investor.required' => 'Введите комментарий.',
            'comment_investor.min' => 'Комментарий должен иметь больше 20 символов.',
        ];
    }

    /**
     * @inheritdoc
     */
    public function prepareForValidation()
    {
    }

}