<?php

namespace App\Http\Requests\Furniture;

use Illuminate\Foundation\Http\FormRequest;

final class FurnitureUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'     => ['required', 'integer', 'exists:users,id'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'title'       => ['nullable', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'min:32'],
            'price'       => ['nullable', 'numeric'],
            'quantity'    => ['nullable', 'integer', 'min:0'],
        ];
    }
}
