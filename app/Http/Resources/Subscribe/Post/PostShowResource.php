<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryShowResource;
use App\Http\Resources\Tag\TagIndexResource;

class PostShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'cat_id' => $this->cat_id,
            'image' => $this->image,
            'views' => $this->views,
            'status' => $this->status,
            'intro' => $this->intro,
            // 'slug' => $this->title,
            'category' => new CategoryShowResource($this->categorys),
            'tags' => TagIndexResource::collection($this->tags),
        ];
    }
}