<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    // Inject ProductService vào controller
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * get products
     * 
     * @param: type: string; search: string;
     * @return array products
     */
    public function getListProducts(Request $request)
    {
        $products = $this->productService->getProductServiceByQuery(
            $request->query('type'),
            $request->query('search'),
        );

        return response()->json([
            'data' => $request->search ? $products : ProductResource::collection($products),
            'message' => 'Ok',
        ]);
    }
}
