<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DirectorsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
            return [
                'data' => $this->collection
            ];
    }

    public function withResponse($request)
    {
        $originalContent = $request->getOriginalContent();
        unset($originalContent['links'],$originalContent['meta']);
        $request->setData($originalContent);
    }
}
