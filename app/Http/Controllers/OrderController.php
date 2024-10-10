<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\ReOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Status;
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

    /**
     * get orders
     * 
     * @param
     * @return array $orders
     */
    public function getOrderPlaces(Request $request)
    {
        // get user id from token
        $userId = $this->decodedToken();

        $data = $this->orderService->getOrderServices($userId, $request->query('status'));

        return response()->json([
            'data' => OrderResource::collection($data),
            'message' => 'Ok',
        ]);
    }

    /**
     * get order just place
     * 
     * @param
     * @return Order $object
     */
    public function getOrderJustPlace()
    {
        // decoded id user by token
        $userId = $this->decodedToken();

        $order = $this->orderService->getOrderJustPlaceService($userId);

        if (!$order) return response()->json(['message' => 'Order not found!'], 404);

        return response()->json([
            'data' => new OrderResource($order)
        ]);
    }

    /**
     * re-orders items
     * 
     * @param Request $request
     * @return Response
     */
    public function reOrderPlace(ReOrderRequest $request)
    {
        $credentials = $request->validated();

        // decoded id user by token
        $userId = $this->decodedToken();

        $res = $this->orderService->reOrderService($credentials['order_items'], $userId);

        return response()->json([
            'data' => $res,
        ]);
    }

    /**
     * get all statuses
     * @param Request $request
     * @return StatusResponse
     */
    public function getStatuses(Request $request)
    {
        $data = Status::all()->map(function ($status) {
            return [
                'id' => $status->getHashedIdAttribute(),
                'name' => $status->name
            ];
        });

        return response()->json([
            'data' => $data,
            'message' => 'Ok',
        ]);
    }
}
