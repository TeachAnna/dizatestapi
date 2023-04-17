<?php

namespace App\Http\Requests\Post;

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
            'intro' => 'nullable|string',
            'content' => 'nullable|string',
            'slug' => 'nullable|string',
            'author' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_key' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'required',
            'category_id' => 'nullable|integer',
            // 'image' => 'required||file',
        ];
    }
}
