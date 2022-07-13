<?php

namespace App\Http\Repositories;

use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductsRepository
{
    public function list($params)
    {
        $query = Products::query();

        if (isset($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (isset($params['name'])) {
            $query->where('name', 'LIKE', "%{$params['name']}%");
        }

        if (isset($params['name']) && isset($params['category'])) {
            $query->where('name', 'LIKE', "%{$params['name']}%")
                ->where('category', $params['category']);
        }

        if (isset($params['category'])) {
            $query->where('category', $params['category']);
        }

        if (isset($params['image'])) {
            if (filter_var($params['image'], FILTER_VALIDATE_BOOLEAN)) {
                $query->whereNotNull('image_url');
            } else {
                $query->whereNull('image_url');
            }
        }

        return $query->get();

        // return $products;
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();

            $products = Products::create($data);
            DB::commit();

            return $products;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function storeFromApi($data)
    {
        if (!Products::where('name', $data['name'])->exists()) {
            Products::create($data);
            return true;
        }

        return false;
    }

    public function update($data, $product)
    {
        try {
            DB::beginTransaction();

            $product->update($data);
            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function destroy($product)
    {
        try {
            DB::beginTransaction();

            $product->delete();
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
