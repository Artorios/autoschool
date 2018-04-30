<?php

namespace App\Http\Requests;

use App\Models\Training\School\AutoSchool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class StoreGroup
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
        $this->request->add([
            'title'             => $this->request->get('title'),
            'description'       => $this->request->get('description'),
            'lesson_num'       => $this->request->get('lesson_num'),
            'youtube'       => $this->request->get('youtube'),
        ]);
    }

}