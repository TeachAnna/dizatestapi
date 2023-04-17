<?php

namespace App\Http\Resources\Team;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'intro' => $this->intro,
            'image' => $this->image,
            'phone' => $this->phone,
            'position' => $this->position,
            'status' => $this->status,
        ];
    }
}
