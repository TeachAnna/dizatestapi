<?php

namespace App\Http\Requests\Item;

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
            'content' => 'nullable|string',
            'image' => 'required|file',
            'status' => 'nullable|string',
        ];
    }
}