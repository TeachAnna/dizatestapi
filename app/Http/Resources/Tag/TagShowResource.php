<?php

namespace App\Http\Resources\Tag;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Post\PostCollectionResource;
class TagShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'intro' => $this->intro,
            'image' => $this->image,
            'status' => $this->status,
             'posts' => PostCollectionResource::collection($this->posts),

        ];
    }
}
