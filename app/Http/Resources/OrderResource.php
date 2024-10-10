<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_date' => $this->order_date,
            'status' => $this->status->name,
            'total_amount' => $this->total_amount,
            'note_message' => $this->note_message,
            'order_items' => $this->whenLoaded('order_items', function () {
                return $this->order_items->map(function ($item) {
                    return [
                        'id' => $item->getHashedIdAttribute(),
                        'slug' => $item->product->slug . '-' . $item->product->getHashedIdAttribute(),
                        'product_id' => $item->product->getHashedIdAttribute(),
                        'product_name' => $item->product->name,
                        'product_image' => $item->product->medias[0]->url,
                        'sub_product_id' => $item->sub_product ? $item->sub_product->getHashedIdAttribute() : null,
                        'sub_product_name' => $item->sub_product->name ?? null,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'sub_total_price' => $item->sub_total_price,
                    ];
                });
            })
        ];
    }
}
