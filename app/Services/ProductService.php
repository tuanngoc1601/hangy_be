<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * get list products by query params
     *
     * @param string|null $type
     * @param string|null $search
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProductServiceByQuery(?string $type, ?string $search)
    {
        if (!is_null($search)) {
            $products = DB::table('products')->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })->get()
                ->map(function ($product) {
                    $product->images = DB::table('medias')
                        ->where('product_id', $product->id)
                        ->select('id', 'url')
                        ->get();
                    return $product;
                });
            // $products = Product::hydrate($products->toArray());
            $productHashids = new Hashids('products', 10);
            $mediaHashids = new Hashids('medias', 10);
            $mappedProducts = $products->map(function ($product) use ($productHashids, $mediaHashids) {
                $product->id = $productHashids->encode($product->id);
                $product->slug = $product->slug . '-' . $product->id;
                $product->images->map(function ($image) use ($mediaHashids) {
                    $image->id = $mediaHashids->encode($image->id);
                    return $image;
                });
                return $product;
            });
            return $mappedProducts;
        }

        if (!is_null($type)) {
            return Product::whereHas('categories', function ($query) use ($type) {
                $query->where('categories.id', Category::decodeHashId($type));
            })->with(['categories', 'medias'])->get();
        }

        return Product::with('medias')->get();
    }

    /**
     * get product detail by slug params
     *
     * @param string $slug
     * @return App\Models\Product;
     */
    public function getProductDetailServiceById(string $slug)
    {
        $decodedId = Product::decodeHashId(substr($slug, -10));

        return Product::with(['sub_products', 'medias'])
            ->where('id', $decodedId)
            ->first();
    }

    /**
     * get best selling products service
     * @param
     * @return array products
     */
    public function getBestSellingProducts()
    {
        $products = Product::with('medias')->orderBy('sold_quantity', 'desc')->take(8)->get();

        return $products;
    }
}
