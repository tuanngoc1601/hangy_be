<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Http\Resources\CartItemResource;
use App\Models\Cart_Item;
use App\Services\CartSerivce;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    protected $cartService;

    // Inject CartService vào controller
    public function __construct(CartSerivce $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * decoded tokens header in request
     * 
     * @param 
     * @return string
     */
    public function decodedToken()
    {
        $token = JWTAuth::parseToken();

        $payload = JWTAuth::getPayload($token);

        return $payload->get('sub');
    }

    /**
     * get cart infor for user
     * 
     * @param $user_id: string
     * @return cart items list: array
     */
    public function getCart(Request $request)
    {
        $userId = $this->decodedToken();

        $carts = $this->cartService->getCartService($userId);

        return response()->json([
            'data' => CartItemResource::collection($carts),
            'message' => 'Ok',
        ]);
    }

    /**
     * add product to cart
     * 
     * @param product object
     * @return Response message
     */
    public function addToCart(AddCartRequest $request)
    {
        // validate request body
        $credentials = $request->validated();

        $userId = $this->decodedToken();

        $cartItem = $this->cartService->addCartService($userId, $credentials);

        return response()->json([
            'data' => 'success',
        ]);
    }

    /**
     * update cart item quantity
     * 
     * @param string $productId
     * @param string $type
     * @return string $message
     */
    public function updateQuantityCart(string $type, string $productId, string $subProductId)
    {
        // get user id by token
        $userId = $this->decodedToken();

        $res = $this->cartService->updateCartItemQuantityService($productId, $subProductId, $type, $userId);

        if (isset($res['code'])) {
            return response()->json([
                'data' => $res['data'],
            ], $res['code']);
        }

        return response()->json($res);
    }

    /**
     * update sub product cart items
     * 
     * @param string $productId
     * @param string | null $subProductId
     * @return string $message
     */
    public function updateSubProductCart(Request $request, string $productId, string $subProductId)
    {
        $request->validate([
            'sub' => 'required|string',
        ]);

        // get user id by token
        $userId = $this->decodedToken();

        $res = $this->cartService->updateCartItemSubProduct($request, $productId, $subProductId, $userId);

        if (isset($res['code'])) {
            return response()->json([
                'data' => $res['data'],
            ], $res['code']);
        }

        return response()->json($res);
    }

    /**
     * delete cart item
     * 
     * @param string $cartItemId
     * @return string $message
     */
    public function deleteCartItem(Request $request, string $cartItemId)
    {
        $decodedId = Cart_Item::decodeHashId($cartItemId);

        $cartItem = Cart_Item::find($decodedId);

        if (!$cartItem) return response()->json(['data' => 'Not found'], 404);

        $cartItem->delete();

        return response()->json(['data' => 'success'], 200);
    }

    /**
     * detele all cart items
     * 
     * @param Request $request
     * @return $string $message
     */
    public function deleteAllCartItems(Request $request)
    {
        $validated = $request->validate([
            'cart_item_ids' => 'required|array',
            'cart_item_ids.*' => 'string',
        ]);

        $decodedIds = array_map(function ($id) {
            return Cart_Item::decodeHashId($id);
        }, $validated['cart_item_ids']);

        $request->merge(['cart_item_ids' => $decodedIds]); // Thay thế giá trị gốc trong request

        $validated = $request->validate([
            'cart_item_ids.*' => 'exists:cart_items,id',
        ]);

        Cart_Item::destroy($validated['cart_item_ids']);

        return response()->json([
            'data' => 'success',
        ]);
    }

    /**
     * get selected cart items to purchase
     * 
     * @param cart_item_ids array string[]
     * @return cart items list: array
     */
    public function getSelectedItems(Request $request)
    {
        $validated = $request->validate([
            'cart_item_ids' => 'required|array',
            'cart_item_ids.*' => 'string',
        ]);

        $decodedIds = array_map(function ($id) {
            return Cart_Item::decodeHashId($id);
        }, $validated['cart_item_ids']);

        $request->merge(['cart_item_ids' => $decodedIds]); // Thay thế giá trị gốc trong request

        $validated = $request->validate([
            'cart_item_ids.*' => 'exists:cart_items,id',
        ]);

        $data = Cart_Item::with(['product', 'sub_product'])->find([$validated]);

        return response()->json([
            'data' => CartItemResource::collection($data),
            'message' => 'Ok',
        ]);
    }
}
