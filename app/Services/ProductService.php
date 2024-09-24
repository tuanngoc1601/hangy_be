<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
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
            return DB::table('products')->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })->get();
        }

        if (!is_null($type)) {
            return Product::whereHas('categories', function ($query) use ($type) {
                $query->where('categories.id', Category::decodeHashId($type));
            })->with('categories')->get();
        }

        return Product::all();
    }
}
