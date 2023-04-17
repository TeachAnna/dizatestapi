<?php

namespace App\Http\Requests\Tab;

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
            'content' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}