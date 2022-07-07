<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function insertData(array $data): Product|bool
    {
        try {
            DB::beginTransaction();

            $product = Product::create($data);

            DB::commit();

            return $product;
        }catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function updateData(array $data, int $id): bool|Product
    {
        try {
            DB::beginTransaction();

            $product = Product::find($id);
            $product->fill($data);
            $product->save();

            DB::commit();

            return $product;
        }catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
