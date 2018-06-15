<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAutoSchoolAdmin extends FormRequest
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

            'title' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'city_id' => 'required|integer|exists:cities,id',
            'director_id' => 'integer',
            'investor_id' => 'integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'title.required' => 'Введите название',
            'title.string' => 'Должна быть строка',
            'title.min' => 'Должно быть больше 5-х символов',
            'description.required' => 'Введите описание',
            'description.string' => 'Должна быть строка',
            'description.min' => 'Должно быть больше 5-х символов',
            'city_id.required' => 'Выберите город',
            'city_id.integer' => 'Ошыбка!',
            'city_id.exists' => 'Ошыбка!',
            'director_id.integer' => 'Ошыбка!',
            'investor_id.integer' => 'Ошыбка!',


        ];
    }
}
