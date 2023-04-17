<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use PDO;

use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Category\CategoryShowResource;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::with('children')->latest()->get();
        return CategoryIndexResource::collection($categorys);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Category::create($data);
        return response([]);
    }

    public function edit(Category $category)
    {
        return new CategoryShowResource($category);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return response([]);
    }

    public function delete(Category $category)
    {
        $category->delete();
    }

}
