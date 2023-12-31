<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        // $this->authorizeResource(Category::class, 'category');
    }

    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        $userId = $request->input('user_id');
        $products = Product::where('category_id', 'LIKE', '%' . $categoryId . '%')
            ->where('user_id', 'LIKE', '%' . $userId . '%')
            ->orderBy('created_at', 'desc')
            ->paginate()->load('category', 'user');
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            ...$request->validate([
                'name' => 'required|string|max:100',
                'description' => 'required|string',
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'image_url' => 'required',
                'category_id' => 'required',
            ]),
            'user_id' => $request->user()->id,
        ]);

        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category', 'user');
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update(
            $request->validate([
                'name' => 'required|string|max:100',
                'description' => 'required|string',
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'image_url' => 'required',
                'category_id' => 'required',
            ])
        );

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(status: 204);
    }
}
