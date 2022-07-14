<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\{
    Request,
    Response
};
use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductsRepository;
use App\Http\Requests\Products\{
    ProductsStoreRequest,
    ProductsUpdateRequest,
};
use App\Http\Resources\Products\ProductsResource;
use App\Models\Products;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->repository = new ProductsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->repository
            ->list($request->only(['id','name','category','image']));

        return ProductsResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsStoreRequest $request)
    {
        $response = $this->repository->store($request->validated());

        return response()->json([
            'error'   => !$response,
            'message' => $response ? 'Cadastrado' : 'Erro ao cadastrar',
            'data'    => $response ? $response : [],
        ], $response ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsUpdateRequest $request, Products $product)
    {
        $response = $this->repository->update($request->validated(), $product);

        return response()->json([
            'error'   => !$response,
            'message' => $response ? 'Atualizado' : 'Erro ao atualizar',
            'data'    => $response ? $response : [],
        ], $response ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $response = $this->repository->destroy($product);

        return response()->json([
            'error'   => !$response,
            'message' => $response ? 'Removido' : 'Erro ao remover',
            'data'    => $response ? $response : [],
        ], $response ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

    }
}
