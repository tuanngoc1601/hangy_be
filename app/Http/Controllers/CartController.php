<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Http\Resources\CartItemResource;
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
}
