<?php

namespace App\Http\Resources\Like;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'like' => $this->like,
        ];
    }
}
