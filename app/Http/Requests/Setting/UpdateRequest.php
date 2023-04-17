<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'header_logo' => 'nullable|string',
            'footer_logo' => 'nullable|string',
            'footer_desc' => 'nullable|string',
            'email' => 'nullable|string|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'youtube' => 'nullable|string',
            'about_title' => 'nullable|string',
            'about_desc' => 'nullable|string',
        ];
    }
}
