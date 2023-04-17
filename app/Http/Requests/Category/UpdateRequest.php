<?php

namespace App\Http\Requests\Category;

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
            'status' => 'required',
            'intro' => 'nullable|string',
            'views' => 'nullable|integer',
            'parent_id' => 'nullable',
        ];
    }
}
