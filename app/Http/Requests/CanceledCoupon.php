<?php

namespace App\Http\Requests;

use App\Models\Training\School\AutoSchool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class CanceledCoupon
 * @package App\Http\Requests
 */
class CanceledCoupon extends FormRequest
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'id.required' => 'Выберите купон.',
        ];
    }

    /**
     * @inheritdoc
     */
    public function prepareForValidation()
    {
    }

}