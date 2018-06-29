<?php

namespace App\Http\Requests\Investor;

use Illuminate\Foundation\Http\FormRequest;

class FeePay extends FormRequest
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
            'auto_school_id' => 'integer|required',
            'summ' => 'integer|required',
            'comment' => 'string|required',
        ];
    }

    public function messages()
    {
        return [
          'auto_school_id.required' => "Ошыбка!",
          'auto_school_id.integer' => "Ошыбка!",
          'summ.required' => "Введите сумму!",
          'summ.double' => "Должно быть число!",
          'comment.string' => "Должна быть строка!",
          'comment.required' => "Введите комментарий!",
        ];
    }
}
