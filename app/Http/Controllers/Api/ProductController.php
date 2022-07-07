<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct()
    {
        $this->service = app(ProductService::class);
    }

    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request)
    {
        return $this->service->storeService($request->all());
    }

    public function update(ProductRequest $request, Product $product)
    {
        return $this->service->updateService($request->all(), $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Produto deletado!'
        ]);
    }
}
