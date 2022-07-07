<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct()
    {
        $this->service = app(ProductService::class);
    }

    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request): JsonResponse|ProductResource
    {
        return $this->service->storeService($request->all());
    }

    public function update(ProductRequest $request, Product $product): JsonResponse|ProductResource
    {
        return $this->service->updateService($request->all(), $product);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Produto deletado!'
        ]);
    }
}
