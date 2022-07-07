<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;

class ProductService
{
    private ProductRepository $repository;

    public function __construct()
    {
        $this->repository = app(ProductRepository::class);
    }

    /**
     * @param array $data
     * @return ProductResource|JsonResponse
     */
    public function storeService(array $data): ProductResource|JsonResponse
    {
        if(Product::where('name', $data['name'])->exists()) {
            return response()->json([
                'type' => 'warning',
                'message' => 'Produto já existente!'
            ]);
        }

        $response = $this->repository->insertData($data);

        return new ProductResource($response);
    }

    /**
     * @param array $data
     * @param Product $product
     * @return ProductResource|JsonResponse
     */
    public function updateService(array $data, Product $product): ProductResource|JsonResponse
    {
        if(Product::where('name', $data['name'])->exists()) {
            return response()->json([
                'type' => 'warning',
                'message' => 'Produto já existente!'
            ]);
        }

        $response = $this->repository->updateData($data, $product->id);

        return new ProductResource($response);
    }

}
