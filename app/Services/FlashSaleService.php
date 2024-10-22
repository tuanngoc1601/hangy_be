<?php

namespace App\Services;

use App\Models\FlashSale;
use Carbon\Carbon;
use Hashids\Hashids;

class FlashSaleService
{
    /**
     * get flash sale products services
     * @param Request $request
     * @return Response
     */
    public function getFlashSaleServices()
    {
        $flash_sale = FlashSale::with('products')
            ->where('time_start', '<=', Carbon::now())
            ->where('time_end', '>=', Carbon::now())
            ->first();

        if (!$flash_sale) return [
            'data' => null,
            'time_start' => null,
            'time_end' => null,
        ];

        $hashids = new Hashids('products', 10);

        $data = $flash_sale->products->map(function ($product) use ($hashids) {
            return [
                'id' => $hashids->encode($product->id),
                'slug' => $product->slug . '-' . $hashids->encode($product->id),
                'name' => $product->name,
                'description' => $product->description,
                'real_price' => $product->real_price,
                'daily_price' => $product->daily_price,
                'flash_sale_price' => $product->flash_sale_price,
                'stock_quantity' => $product->stock_quantity,
                'sold_quantity' => $product->sold_quantity,
                'images' => $product->medias->map(function ($image) {
                    return [
                        'id' => $image->getHashedIdAttribute(),
                        'url' => $image->url,
                    ];
                })
            ];
        });

        return [
            'data' => $data,
            'time_start' => $flash_sale->time_start,
            'time_end' => $flash_sale->time_end
        ];
    }
}
