<?php

namespace App\Http\Requests\Team;

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
            'name' => 'required|string',
            'intro' => 'nullable|string',
            'image' => 'required|file',
            'position' => 'nullable|string',
            'phone' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}