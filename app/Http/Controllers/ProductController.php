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

    /**
     * get product details by slug
     * 
     * @param slug: string;
     * @return new Product
     */
    public function getProductDetail(Request $request, string $slug)
    {
        if (!$slug) {
            return response()->json([
                'message' => 'Parameter is not valid!',
            ], 400);
        }

        $product = $this->productService->getProductDetailServiceById($slug);

        return response()->json([
            'data' => new ProductResource($product),
            'message' => 'Ok',
        ]);
    }
}
