<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ProductsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id= : The ID of the product}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import fake products from fakestoreapi.com';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $productId = (int) $this->option('id');

        // Product id defined
        if ($productId) {
            $this->line(sprintf('Importing fake product: %d', $productId));
            $this->newLine();

            $fakeProducts = Http::get(sprintf('https://fakestoreapi.com/products/%d', $productId))->json();

            if (is_null($fakeProducts)) {
                $this->error('Product not found');
                return;
            }

            $fakeProducts = collect([$fakeProducts]);

        } else {
            // 10 fake products
            $this->line('Importing fake products');
            $this->newLine();

            $fakeProducts = Http::get('https://fakestoreapi.com/products?limit=10')->collect();
        }

        // import products
        $fakeProducts->each(function ($fakeProduct) {
            // Check for duplicates
            if (Product::where('name', $fakeProduct['title'])->exists()) {
                $this->error(sprintf('Product "%s" already exists', $fakeProduct['title']));

            } else {
                $product = new Product();

                $product->name        = $fakeProduct['title'];
                $product->price       = $fakeProduct['price'];
                $product->description = $fakeProduct['description'];
                $product->category    = $fakeProduct['category'];
                $product->image_url   = $fakeProduct['image'];

                $product->save();

                // output current product imported
                $this->line(sprintf('Product "%s" imported', $fakeProduct['title']));
            }
        });

        $this->newLine();
        $this->info('Import finished');
    }
}
