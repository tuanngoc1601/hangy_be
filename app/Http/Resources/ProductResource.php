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
            'images' => $this->whenLoaded('medias', function () {
                return $this->medias->map(function ($image) {
                    return [
                        'id' => $image->getHashedIdAttribute(),
                        'url' => $image->url,
                    ];
                });
            }),
            'sub_products' => $this->whenLoaded('sub_products', function () {
                return $this->sub_products->map(function ($subProduct) {
                    return [
                        'id' => $subProduct->getHashedIdAttribute(),
                        'name' => $subProduct->name,
                        'real_price' => $subProduct->real_price,
                        'daily_price' => $subProduct->daily_price,
                        'flash_sale_price' => $subProduct->flash_sale_price,
                        'stock_quantity' => $subProduct->stock_quantity,
                        'sold_quantity' => $subProduct->sold_quantity,
                        'product_id' => $this->getHashedIdAttribute(),
                        'image_url' => $subProduct->image_url,
                    ];
                });
            }),
        ];
    }
}
