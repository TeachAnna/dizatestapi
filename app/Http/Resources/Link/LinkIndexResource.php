<?php

namespace App\Http\Resources\Link;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'image' => $this->image,
            'status' => $this->status,
        ];
    }
}
