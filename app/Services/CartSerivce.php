<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Product;
use App\Models\Sub_Product;

class CartSerivce
{
    /**
     * get cart service
     * 
     * @param string $user_id
     * @return cart items : array | empty array
     */
    public function getCartService(int $user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();

        if (!$cart) return [];

        $cartItems = Cart_Item::with(['product', 'sub_product'])->where('cart_id', $cart->id)->get();

        return $cartItems;
    }

    /**
     * add products to cart services
     * 
     * @param string $userId
     * @return string $messages
     */
    public function addCartService(int $user_id, $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $user_id,
        ]);

        $item = Cart_Item::where('cart_id', $cart->id)
            ->where('product_id', Product::decodeHashId($request['product_id']))
            ->where('sub_product_id', Sub_Product::decodeHashId($request['sub_product_id']))
            ->first();

        if ($item) {
            $item->quantity = $item->quantity + 1;
            $item->amount = $item->amount + $item->price;
            $item->save();

            return $item;
        } else {
            $newItem = Cart_Item::create([
                'cart_id' => $cart->id,
                'product_id' => Product::decodeHashId($request['product_id']),
                'sub_product_id' => Sub_Product::decodeHashId($request['sub_product_id']),
                'quantity' => $request['quantity'],
                'price' => $request['price'],
                'amount' => $request['amount'],
            ]);

            return $newItem;
        }
    }
}
