<?php

namespace App\Http\Requests\Video;

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
            'title' => 'required|string',
            'url' => 'required|string',
            'intro' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}