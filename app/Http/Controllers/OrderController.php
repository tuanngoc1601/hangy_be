<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    protected $orderService;

    // Inject OrderService vào controller
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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
     * create order
     * 
     * @param Request $request
     * @return Response
     */
    public function createOrder(OrderRequest $request)
    {
        $validated = $request->validated();

        // decoded id user by token
        $userId = $this->decodedToken();

        $res = $this->orderService->storeOrderService($validated, $userId);

        return response()->json($res);
    }
}
