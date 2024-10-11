<?php

namespace App\Http\Requests\Furniture;

use Illuminate\Foundation\Http\FormRequest;

final class FurnitureStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'     => ['required', 'integer', 'exists:users,id'],
            'title'       => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:32'],
            'price'       => ['numeric', 'gte:0'],
            'quantity'    => ['integer', 'min:1'],
        ];
    }
}
