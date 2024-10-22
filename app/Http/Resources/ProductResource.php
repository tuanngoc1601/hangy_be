<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $flash_sale = $this->flash_sales()
            ->where('time_start', '<=', Carbon::now())
            ->where('time_end', '>=', Carbon::now())
            ->first();

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
            'is_flash_sales' => $flash_sale ? true : false,
            'flash_sale_end_time' => $flash_sale ? $flash_sale->time_end : null,
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
