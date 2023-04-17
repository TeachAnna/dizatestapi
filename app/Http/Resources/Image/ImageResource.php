<?php

namespace App\Http\Resources\Image;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Desk\DeskCollectionResource;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'desk_id' => $this->desk_id,
            // 'preview_url' => $this->preview_url
            'desk' => new DeskCollectionResource($this->desk),
            'size' => Storage::disk('public')->size($this->path),
            'name' => str_replace('images/', '', $this->path),

        ];
    }
}