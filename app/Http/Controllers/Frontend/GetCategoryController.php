<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Category\CategoryShowResource;


class GetCategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::where('parent_id', 0)->with('children')->latest()->get();
        return CategoryIndexResource::collection($categorys);
    }


    public function show($id)
    {
        try {
            $categorys = Category::with('posts')->findOrFail($id);
            $categorys->save();
            return response()->json([
                'success' => true,
                'categorys' => $categorys,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
