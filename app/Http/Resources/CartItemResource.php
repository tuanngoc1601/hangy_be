<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'quantity' => $this->quantity,
            'price' => $this->price,
            'amount' => $this->amount,
            'product' => $this->whenLoaded('product', function ($product) {
                return [
                    'id' => $product->getHashedIdAttribute(),
                    'name' => $product->name,
                    'real_price' => $product->real_price,
                    'daily_price' => $product->daily_price,
                    'flash_sale_price' => $product->flash_sale_price,
                    'stock_quantity' => $product->stock_quantity,
                    'sold_quantity' => $product->sold_quantity,
                    'image_url' => $product->image_url,
                ];
            }),
            'sub_product' => $this->whenLoaded('sub_product', function ($sub_product) {
                return [
                    'id' => $sub_product->getHashedIdAttribute(),
                    'name' => $sub_product->name,
                    'real_price' => $sub_product->real_price,
                    'daily_price' => $sub_product->daily_price,
                    'flash_sale_price' => $sub_product->flash_sale_price,
                    'stock_quantity' => $sub_product->stock_quantity,
                    'sold_quantity' => $sub_product->sold_quantity,
                    'image_url' => $sub_product->image_url,
                ];
            })
        ];
    }
}
