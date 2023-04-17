<?php

namespace App\Http\Resources\Response;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'intro' => $this->intro,
            'image' => $this->image,
            'email' => $this->email,
            'status' => $this->status,
        ];
    }
}
