<?php

namespace App\Http\Resources\Subscribe;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscribeIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
        ];
    }
}