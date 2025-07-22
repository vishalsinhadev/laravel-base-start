<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Make sure the user is authorized
    }

    public function rules(): array
    {
        return [
            'owner_name' => 'required|string|max:255',
            'decription' => 'required|string',
            'image' => 'required|string',
            'tag' => 'required|string',
            'filter' => 'required|string',
        ];
    }
}
