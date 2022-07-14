<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductsRepository;
use App\Http\Resources\Products\ProductsResource;
use Illuminate\Http\{
    Request,
    Response
};
use App\Http\Requests\Products\{
    ProductsStoreRequest,
    ProductsUpdateRequest,
};

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
    public function update(ProductsUpdateRequest $request, $id)
    {
        $response = $this->repository->update($request->validated(), $id);

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
    public function destroy($id)
    {
        $response = $this->repository->destroy($id);

        return response()->json([
            'error'   => !$response,
            'message' => $response ? 'Removido' : 'Erro ao remover',
            'data'    => $response ? $response : [],
        ], $response ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

    }
}
