<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'intro' => $this->intro,
            'image' => $this->image,
            'status' => $this->status,
        ];
    }
}
