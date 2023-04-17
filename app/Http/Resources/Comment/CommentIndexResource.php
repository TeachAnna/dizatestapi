<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'name' => $this->name,
            'email' => $this->email,
            'comment' => $this->comment,
            // 'status' => $this->status,
        ];
    }
}
