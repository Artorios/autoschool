<?php

namespace App\Http\Requests\Investor;

use Hash;
use App\Http\Requests\BaseRequest;

class UpdatePasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (! Hash::check($value, $this->user()->password)) {
                    $fail('Старый пароль не верный.');
                }
            }],
            'password' => 'required|min:8|max:25|confirmed',
        ];
    }
}
