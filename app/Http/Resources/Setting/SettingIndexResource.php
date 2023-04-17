<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'header_logo' => $this->header_logo,
            'footer_logo' => $this->footer_logo,
            'footer_desc' => $this->footer_desc,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'about_title' => $this->about_title,
            'about_desc' => $this->about_desc,
        ];
    }
}