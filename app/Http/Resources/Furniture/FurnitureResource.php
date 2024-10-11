<?php

namespace App\Http\Resources\Furniture;

use Illuminate\Http\Resources\Json\JsonResource;

final class FurnitureResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
        ];
    }
}
