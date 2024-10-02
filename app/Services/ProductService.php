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
            })->get();
            // $products = Product::hydrate($products->toArray());
            $hashids = new Hashids('products', 10);
            $mappedProducts = $products->map(function ($product) use ($hashids) {
                $product->id = $hashids->encode($product->id);
                $product->slug = $product->slug . '-' . $product->id;
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
}
