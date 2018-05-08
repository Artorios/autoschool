<?php

namespace App\Http\Requests\Investor;

use App\Models\Training\School\AutoSchool;
use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->id == AutoSchool::find($this->auto_school)->investor_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'auto_school' => 'required|exists:auto_schools,id',
            'count' => 'integer|min:1',
            'commision_amount' => 'integer|min:1',
        ];
    }
}
