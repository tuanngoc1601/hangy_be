<?php

namespace App\Http\Controllers;

use App\Services\FlashSaleService;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    protected $flashSaleService;

    // Inject flashSaleService vào controller
    public function __construct(FlashSaleService $flashSaleService)
    {
        $this->flashSaleService = $flashSaleService;
    }

    /**
     * get flash sales
     * 
     * @param Request $request
     * @return Response
     */
    public function getFlashSales(Request $request)
    {
        $data = $this->flashSaleService->getFlashSaleServices();

        return response()->json([
            'data' => [
                'is_flash_sales' => true,
                'time_start' => $data['time_start'],
                'time_end' => $data['time_end'],
                'product_sales' => $data['data'],
            ],
        ]);
    }
}
