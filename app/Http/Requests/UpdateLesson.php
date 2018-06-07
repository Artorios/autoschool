<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateLesson
 * @package App\Http\Requests
 */
class UpdateLesson extends FormRequest
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
            'title'               => 'string',
            'description'         => 'string',
            'training_errors_num' => 'integer',
            'exam_errors_num'     => 'integer',
            'license'             => Rule::in(['A','B','C'])
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