<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products {--id=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://fakestoreapi.com/products/'. $this->option('id'));

        if($response->failed()) {
            $this->info('Houve algum erro ao tentar buscar pela api ');
        }

        if('?' == $this->option('id')) {
            foreach($response->object() as $data) {
                if(Product::where('name', $data->title)->exists()) {
                    continue;
                }
                $data = $this->createData($data);
                (new ProductRepository())->insertData($data);
            }

            $this->info('Produtos cadastro com sucesso');
            return 1;
        }


        $data = $this->createData(json_decode($response->body()));
        (new ProductRepository())->insertData($data);

        $this->info('Produto cadastro com sucesso');
        return 1;

    }

    private function createData(object $data): array
    {
        $newData = [];

        $newData['name'] = $data->title;
        $newData['price'] = $data->price;
        $newData['description'] = $data->description;
        $newData['category'] = $data->category;
        $newData['image_url'] = $data->image ?? null;

        return $newData;;
    }
}
