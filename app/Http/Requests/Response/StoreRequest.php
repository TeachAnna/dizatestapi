<?php

namespace App\Http\Requests\Response;

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
            'image' => 'nullable',
            'status' => 'nullable|string',
            'email' => 'nullable|string',
        ];
    }
}