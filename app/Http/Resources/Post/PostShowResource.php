<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryShowResource;
use App\Http\Resources\Tag\TagIndexResource;
use Carbon\Carbon;

class PostShowResource extends JsonResource
{
    public function toArray($request)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'slug' => $this->slug,
            'intro' => $this->intro,
            'views' => $this->views,
            'status' => $this->status,
            'image' => $this->image,
            'author' => $this->author,
            // 'like' => $this->like,
            // 'home' => $this->home,
            // 'cod' => $this->code,
            'category_id' => $this->category_id,
            // 'user_id' => $this->user_id,
            'category' => new CategoryShowResource($this->category),
            'tags' => TagIndexResource::collection($this->tags),
            'meta_description' => $this->meta_description,
            'meta_title' => $this->meta_title,
            'meta_key' => $this->meta_key,
            'created_at'=> $date,

        ];
    }
}
