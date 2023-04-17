<?php

namespace App\Http\Requests\Slide;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'intro' => 'nullable|string',
            'image' => 'nullable',
            'status' => 'nullable|string',
        ];
    }
}