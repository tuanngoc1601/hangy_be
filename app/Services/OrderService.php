<?php

namespace App\Services;

use App\Models\Cart_Item;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * create new order service
     * 
     * @param array string[] $items
     * @return Response $message
     */
    public function storeOrderService(array $items, int $userId)
    {
        $decodedIds = array_map(function ($id) {
            return Cart_Item::decodeHashId($id);
        }, $items['cart_item_ids']);

        // array_merge($items, ['cart_item_ids' => $decodedIds]);
        $items['cart_item_ids'] = $decodedIds;

        DB::transaction(function () use ($userId, $items) {
            $newOrder = Order::create([
                'user_id' => $userId,
                'order_date' => now(),
                'status_id' => 1,
                'total_amount' => $items['total_amount'],
                'note_message' => $items['note_message']
            ]);

            foreach ($items['cart_item_ids'] as $item) {
                $cartItem = Cart_Item::find($item);
                
                $newOrderItem = Order_Item::create([
                    'order_id' => $newOrder->id,
                    'product_id' => $cartItem->product_id,
                    'sub_product_id' => $cartItem->sub_product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'sub_total_price' => $cartItem->amount,
                ]);

                $cartItem->delete();
            }
        });

        return ['data' => 'success'];
    }
}
