<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string'
            ],
            'body' => [
                'required',
                'string'
            ]
        ];
    }

    public function attributes()
    {
        return [];
    }
}
