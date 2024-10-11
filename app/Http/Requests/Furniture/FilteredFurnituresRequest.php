<?php

declare(strict_types=1);

namespace App\Http\Requests\Furniture;

use Illuminate\Foundation\Http\FormRequest;

final class FilteredFurnituresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'       => ['string', 'min:3', 'max:255'],
            'price'        => ['array'],
            'price.min'    => ['numeric', 'gte:0'],
            'price.max'    => ['numeric', 'gte:0'],
            'quantity'     => ['array'],
            'quantity.min' => ['integer', 'min: 0'],
            'quantity.max' => ['integer', 'min: 1'],
            'per_page'     => ['integer', 'min:1']
        ];
    }
}
