<?php

namespace App\Http\Requests;

use App\Models\User\User;
use Illuminate\{
    Foundation\Http\FormRequest,
    Support\Facades\Auth,
    Support\Facades\Hash
};

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'hash:' . User::find(Auth::id())->password,
            'password'     => [
                'required',
                'min:6',
                'confirmed',
            ]
        ];
    }
}