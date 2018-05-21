<?php

namespace App\Http\Requests\Investor;

use App\Http\Requests\BaseRequest;

class HistoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'query' => 'string',
            'autoschool' => 'integer',
        ];
    }
}
