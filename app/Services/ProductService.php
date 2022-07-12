<?php

namespace App\Services;

use App\Helpers\TypesReturn;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService extends TypesReturn
{
    private ProductRepository $repository;

    public function __construct()
    {
        $this->repository = app(ProductRepository::class);
    }

    /**
     * @param array $data
     * @return ProductResource|JsonResponse|AnonymousResourceCollection
     */
    public function searchProduct(array $data): ProductResource|JsonResponse|AnonymousResourceCollection
    {
       if(data_get($data, 'id')) {
           if(! $product = Product::find($data['id'])) {
               return $this->response('warning', 'Produto não encontrado!');
           }
           return new ProductResource($product);
       }

       if(data_get($data, 'name') && data_get($data,'category')) {
         $product = Product::where('name', $data['name'])->where('category', $data['category']);
         if(! $product->exists()) {
             return $this->response('warning', 'Produto não encontrado!');
         }

         return ProductResource::collection($product->get());
       }

       if(data_get($data, 'category')) {
           $product = Product::where('category', $data['category']);
           if(! $product->exists()) {
                return $this->response('warning', 'Categoria não encontrada!');
            }

           return ProductResource::collection($product->get());
       }

       if(data_get($data, 'image') || ! $data['image']) {
           $product = Product::where('image_url', $data['image']);
           if(! $product->exists()) {
               return $this->response('warning', 'Produto não encontrado!');
           }

           return ProductResource::collection($product->get());
       }

       return $this->response('error', 'Houve algum erro ao tentar buscar pelo produto', 500);
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
        $response = $this->repository->updateData($data, $product->id);

        return new ProductResource($response);
    }
}
