<?php

namespace App\Http\Requests\Item;

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
            'image' => 'required|file',
            'content' => 'nullable|string',
        ];
    }
}