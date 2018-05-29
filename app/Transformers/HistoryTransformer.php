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
        $autoschool = AutoSchool::find($history->auto_school_id);
        return [
            "id"          => $history->id,
            "investor_id" => $history->investor_id,
            "auto_school" => [
                'id' => $autoschool->id,
                'title' => $autoschool->title
            ],
            "operation"   => $history->operation,
            "comment"     => $history->comment,
            "updated_at"  => (string)$history->updated_at,
        ];
    }
}
