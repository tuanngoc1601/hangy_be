<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getHashedIdAttribute(),
            'name' => $this->name,
            'slug' => $this->slug . '-' . $this->getHashedIdAttribute(),
            'description' => $this->description,
            'real_price' => $this->real_price,
            'daily_price' => $this->daily_price,
            'flash_sale_price' => $this->flash_sale_price,
            'stock_quantity' => $this->stock_quantity,
            'sold_quantity' => $this->sold_quantity,
            'image_url' => $this->image_url,
        ];
    }
}
