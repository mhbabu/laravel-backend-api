<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return new CategoryResource($category);
    }

    public function show($categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) return response()->json(['message' => 'Category not found.'], 404);
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    public function destroy($categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) return response()->json(['message' => 'Category not found.'], 404);

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.'], 200);
    }

    public function getActiveCategories() {
        $categories = Category::where('status', 'active')->get();
        return CategoryResource::collection($categories);
    }
}
