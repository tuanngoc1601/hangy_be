<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Product;
use App\Models\Sub_Product;
use Illuminate\Http\Request;

class CartSerivce
{
    /**
     * find cart items
     * @param int $cartId
     * @param string $productId
     * @param string $subProductId
     */
    public function findCartItem(string $cartId, string $productId, $subProductId)
    {
        if ($subProductId)
            return Cart_Item::where('cart_id', $cartId)
                ->where('product_id', Product::decodeHashId($productId))
                ->where('sub_product_id', Sub_Product::decodeHashId($subProductId))
                ->first();

        return Cart_Item::where('cart_id', $cartId)
            ->where('product_id', Product::decodeHashId($productId))
            ->whereNull('sub_product_id')
            ->first();
    }

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

        $cartItems = Cart_Item::with(['product.sub_products', 'product.medias', 'sub_product'])->where('cart_id', $cart->id)->get();

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

        $item = $this->findCartItem($cart->id, $request['product_id'], $request['sub_product_id']);

        if ($item) {
            $item->quantity = $item->quantity + 1;
            $item->amount = $item->amount + $item->price;
            $item->save();

            return $item;
        } else {
            $newItem = Cart_Item::create([
                'cart_id' => $cart->id,
                'product_id' => Product::decodeHashId($request['product_id']),
                'sub_product_id' => $request['sub_product_id'] ? Sub_Product::decodeHashId($request['sub_product_id']) : null,
                'quantity' => $request['quantity'],
                'price' => $request['price'],
                'flash_sale_price' => $request['flash_sale_price'],
                'amount' => $request['amount'],
                'flash_sale_amount' => $request['flash_sale_amount']
            ]);

            return $newItem;
        }
    }

    /**
     * update cart item quantity service
     * 
     * @param string $productId
     * @param string $type
     * @return message
     */
    public function updateCartItemQuantityService(string $productId, string $subProductId, string $type, int $user_id)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $user_id,
        ]);

        $cartItem = $this->findCartItem($cart->id, $productId, $subProductId);

        if (!$cartItem) {
            return ['data' => 'Not found', 'code' => 404];
        }

        if ($type === "increase") {
            $cartItem->quantity += 1;
            $cartItem->amount += $cartItem->price;
            $cartItem->save();
            return ['data' => 'success'];
        }

        if ($cartItem->quantity === 1) {
            $cartItem->delete();
        } else {
            $cartItem->quantity -= 1;
            $cartItem->amount -= $cartItem->price;
            $cartItem->save();
        }

        return ['data' => 'success'];
    }

    /**
     * update sub product cart item service
     * @param string $productId
     * @param string | null $subProductId
     * @return string
     */
    public function updateCartItemSubProduct(Request $request, string $productId, string $subProductId, int $user_id)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $user_id,
        ]);

        $cartItem = $this->findCartItem($cart->id, $productId, $subProductId);

        if (!$cartItem) {
            return ['data' => 'Not found', 'code' => 404];
        }

        $cartItem->sub_product_id = Sub_Product::decodeHashId($request->sub);

        $subProduct = Sub_Product::find(Sub_Product::decodeHashId($request->sub));

        if ($subProduct->daily_price) {
            $cartItem->price = $subProduct->daily_price;
        } else {
            $product = Product::find(Product::decodeHashId($productId));
            $cartItem->price = $product->daily_price;
        }

        $cartItem->amount = $cartItem->quantity * $cartItem->price;

        $cartItem->save();

        return ['data' => 'success'];
    }
}
