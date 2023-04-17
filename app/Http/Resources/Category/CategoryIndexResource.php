<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Post\PostCollectionResource;
use App\Http\Resources\Post\PostIndexResource;
class CategoryIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'intro' => $this->intro,
            'views' => $this->views,
            'parent_id' => $this->parent_id,
            'children' => $this->children,
'posts' => PostCollectionResource::collection($this->posts),
// 'posts' => PostIndexResource::collection($this->posts),
        ];
    }
}
