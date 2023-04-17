<?php

namespace App\Http\Resources\Slide;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideIndexResource extends JsonResource
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
