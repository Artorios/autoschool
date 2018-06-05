<?php

namespace App\Http\Requests;

use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use Illuminate\Foundation\Http\FormRequest;

class NewStudent extends FormRequest
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
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'string|min:3',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required',
            'coupon' 		  => 'nullable|exists:coupons,id',
            'auto_school_group_id' 		  => 'required|exists:auto_school_groups,id',
            'city_id' 		  => 'required|exists:cities,id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function prepareForValidation()
    {

        $group = AutoSchoolGroup::find($this->request->all()['auto_school_group_id']);
        $school = AutoSchool::find($group->auto_school_id);
        $this->request->add([
            'city_id' => $school->city_id

            ]);
    }

}
