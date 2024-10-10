<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Product;
use App\Models\Status;
use App\Models\Sub_Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * find cart item
     * @param string $product_id
     * @param string | null $sub_product_id
     * @param int #cartId
     * 
     * @return Cart_Item $cart_item
     */
    public function findCartItem($cartId, $product_id, $sub_product_id)
    {
        if ($sub_product_id)
            return Cart_Item::where('cart_id', $cartId)
                ->where('product_id', Product::decodeHashId($product_id))
                ->where('sub_product_id', Sub_Product::decodeHashId($sub_product_id))
                ->first();

        return Cart_Item::where('cart_id', $cartId)
            ->where('product_id', Product::decodeHashId($product_id))
            ->whereNull('sub_product_id')
            ->first();
    }

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

    /**
     * get order services
     * 
     * @param int $userId
     * @return array $orders
     */
    public function getOrderServices(int $userId, ?string $status)
    {
        if (!is_null($status)) {
            $status_id = Status::decodeHashId($status);
            return Order::with(['order_items', 'status'])
                ->where('user_id', $userId)->where('status_id', $status_id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        return Order::with(['order_items', 'status'])->where('user_id', $userId)
            ->orderBy('created_at', 'desc')->paginate(5);
    }

    /**
     * get order just placed service
     * 
     * @param int $userId
     * @return Order $object
     */
    public function getOrderJustPlaceService(int $userId)
    {
        return Order::with(['order_items', 'status'])
            ->where('order_date', Carbon::now()->format('Y-m-d'))
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * re orders services
     * 
     * @param Request $request
     * @param int $userId
     * @return string $message
     */
    public function reOrderService($orders, $userId)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $userId,
        ]);

        $cart_item_ids = [];

        DB::transaction(function () use ($cart, $orders, &$cart_item_ids) {
            foreach ($orders as $orderItem) {
                $item = $this->findCartItem($cart->id, $orderItem['product_id'], $orderItem['sub_product_id']);
                if ($item) {
                    $item->quantity = $item->quantity + $orderItem['quantity'];
                    $item->amount = $item->amount + $orderItem['sub_total_price'];
                    $item->save();

                    array_push($cart_item_ids, $item->getHashedIdAttribute());
                } else {
                    $newItem = Cart_Item::create([
                        'cart_id' => $cart->id,
                        'product_id' => Product::decodeHashId($orderItem['product_id']),
                        'sub_product_id' => $orderItem['sub_product_id'] ? Sub_Product::decodeHashId($orderItem['sub_product_id']) : null,
                        'quantity' => $orderItem['quantity'],
                        'price' => $orderItem['price'],
                        'amount' => $orderItem['sub_total_price'],
                    ]);

                    array_push($cart_item_ids, $newItem->getHashedIdAttribute());
                }
            }
        });

        return $cart_item_ids;
    }
}
