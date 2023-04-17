<?php

namespace App\Http\Resources\Desk;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Image\ImageResource;


use Carbon\Carbon;

class DeskIndexResource extends JsonResource
{

    public function toArray($request)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d');

        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
