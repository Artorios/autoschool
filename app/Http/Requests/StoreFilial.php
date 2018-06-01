<?php

namespace App\Http\Requests;

use App\Models\Training\School\AutoSchool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class StoreFilial
 * @package App\Http\Requests
 */
class StoreFilial extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'filial_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'director_id' => 'required|integer',
            'investor_id' => 'required|integer',
            'city_id' => 'required|integer',
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
        $school = AutoSchool::where('director_id', Auth::user()->id)->where('filial_name', null)->first();
        if (empty($school)) {
            $school = AutoSchool::where('director_id', Auth::user()->id)->first();
        }
        $this->request->add([
            'filial_name' => $this->request->get('name'),
            'title' => $school->title,
            'description' => $school->description,
            'director_id' => Auth::user()->id,
            'investor_id' => 0,
            'city_id' => $school->city_id,
        ]);
    }

}