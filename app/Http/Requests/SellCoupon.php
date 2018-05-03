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
            'auto_school_id' => 'required|integer',
            'name'           => 'required|string|max:255',
            'exam_date'      => 'required|date',
            'exam_time'      => 'required|date_format:H:i',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function prepareForValidation()
    {
    }

}