<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Post\PostIndexResource;
class CategoryShowResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'intro' => $this->intro,
            'views' => $this->views,
            'posts' => PostIndexResource::collection($this->posts),
        ];
    }
}
