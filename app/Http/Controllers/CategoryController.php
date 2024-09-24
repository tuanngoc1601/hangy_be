<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * get all categories
     * @param \App\Http\Request $request
     * @return array
     */
    public function getAllCategories(Request $request)
    {
        return response()->json([
            'data' => CategoryResource::collection(Category::all()),
            'message' => 'Ok',
        ]);
    }
}
