<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $flash_sale = $this->product->flash_sales()
            ->where('time_start', '<=', Carbon::now())
            ->where('time_end', '>=', Carbon::now())
            ->first();

        return [
            'id' => $this->getHashedIdAttribute(),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'flash_sale_price' => $this->flash_sale_price,
            'amount' => $this->amount,
            'flash_sale_amount' => $this->flash_sale_amount,
            'product' => $this->whenLoaded('product', function ($product) use ($flash_sale) {
                return [
                    'id' => $product->getHashedIdAttribute(),
                    'name' => $product->name,
                    'real_price' => $product->real_price,
                    'daily_price' => $product->daily_price,
                    'flash_sale_price' => $product->flash_sale_price,
                    'stock_quantity' => $product->stock_quantity,
                    'sold_quantity' => $product->sold_quantity,
                    'is_flash_sales' => $flash_sale ? true : false,
                    'images' => $this->when($this->relationLoaded('product') && $this->product->relationLoaded('medias'), function () use ($product) {
                        return $product->medias->map(function ($image) {
                            return [
                                'id' => $image->getHashedIdAttribute(),
                                'url' => $image->url,
                            ];
                        });
                    }),
                    'sub_products' => $this->when($this->relationLoaded('product') && $this->product->relationLoaded('sub_products'), function () use ($product) {
                        return $product->sub_products->map(function ($subProduct) {
                            return [
                                'id' => $subProduct->getHashedIdAttribute(),
                                'name' => $subProduct->name,
                                'real_price' => $subProduct->real_price,
                                'daily_price' => $subProduct->daily_price,
                                'flash_sale_price' => $subProduct->flash_sale_price,
                                'stock_quantity' => $subProduct->stock_quantity,
                                'sold_quantity' => $subProduct->sold_quantity,
                                'image_url' => $subProduct->image_url,
                            ];
                        });
                    }),
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
