<?php

namespace App\Http\Resources\Accordion;

use Illuminate\Http\Resources\Json\JsonResource;

class AccordionIndexResource extends JsonResource
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
