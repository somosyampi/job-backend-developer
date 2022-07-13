<?php

namespace App\Console\Commands;

use App\Http\Repositories\ProductsRepository;
use App\Jobs\StoreProductsFromApiJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Products;
use Illuminate\Support\Facades\Log;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get products from Fake Store Api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->callApi();

        if ($this->option('id') !== "?") {
            $product = $this->organizeData(json_decode($response->body()));

            (new ProductsRepository() )->storeFromApi($product);

            $this->info("Produto cadastrado com sucesso!");
            return;
        }

        $numberOfProductsStored = 0;
        foreach ($response->object() as $product) {
            $dataProduct = $this->organizeData($product);
            $store = (new ProductsRepository() )->storeFromApi($dataProduct);

            if ($store) $numberOfProductsStored++;
        }

        $this->info("{$numberOfProductsStored} produtos cadastrados.");
        return;
    }

    private function callApi()
    {
        $response = Http::get('https://fakestoreapi.com/products/' . $this->option('id'));

        if ($response->failed()) {
            $this->info('Erro ao conectar com a api');
            Log::channel('products_import')->warning('Erro ao conectar com a api');
            exit;
        }

        return $response;
    }

    private function organizeData($data)
    {
        $product = [
            'name'        => $data->title,
            'price'       => $data->price,
            'description' => $data->description,
            'category'    => $data->category,
            'image_url'   => $data->image
        ];

        return $product;
    }
}
