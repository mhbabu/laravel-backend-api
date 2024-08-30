<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories', 'features')->paginate(10);
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create($request->validated());
            $product->categories()->sync($request->categories);

            foreach ($request->features as $feature) {
                $product->features()->create(['name' => $feature]);
            }

            if ($request->hasFile('image')) {
                $product->addMediaFromRequest('image')->toMediaCollection('product_images');
            }
            $product->load('media');

            DB::commit();
            return new ProductResource($product->load('categories', 'features'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create product'], 500);
        }
    }

    public function show($productId)
    {
        $product = Product::find($productId);
        if (!$product) return response()->json(['message' => 'Product not found.'], 404);

        return new ProductResource($product->load('categories', 'features'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update(['title' => $request->title]);

        if ($request->hasFile('image')) {
            $product->clearMediaCollection('product_images');
            $product->addMediaFromRequest('image')->toMediaCollection('product_images');
        }
        $product->load('media');

        return new ProductResource($product->load('categories', 'features'));
    }

    public function destroy($productId)
    {
        $product = Product::find($productId);
        if (!$product) return response()->json(['message' => 'Product not found.'], 404);

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }
}
