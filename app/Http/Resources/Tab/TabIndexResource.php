<?php

namespace App\Http\Resources\Tab;

use Illuminate\Http\Resources\Json\JsonResource;

class TabIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
        ];
    }
}
