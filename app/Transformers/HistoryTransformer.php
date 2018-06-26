<?php

namespace App\Transformers;

use App\Models\Training\School\AutoSchool;
use App\Models\User\History;
use League\Fractal\TransformerAbstract;

class HistoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(History $history)
    {
        return [
            "id"          => $history->id,
            "investor_id" => $history->investor_id,
            "auto_school" => [
                'id' => $history->school->id,
                'title' => $history->school->title
            ],
            "operation"   => $history->operation,
            "comment"     => $history->comment,
            "updated_at"  => (string)$history->updated_at,
        ];
    }
}
