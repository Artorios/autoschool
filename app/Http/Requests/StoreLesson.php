<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreLesson
 * @package App\Http\Requests
 */
class StoreLesson extends FormRequest
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
            'title'         => 'required|string',
            'description'   => 'required|string',
            'lesson_num'    => 'required|integer',
            'youtube'       => 'string|nullable',
            'videos_name'   => 'string|nullable',
            'videos_type'   => 'string|nullable',
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