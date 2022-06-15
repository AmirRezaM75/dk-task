<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Console\Command;

class ImportProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products {path : Absolute path to JSON file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from given JSON file and insert it to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $content = file_get_contents($this->argument('path'));

        $products = json_decode($content, true)['products'];

        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'price' => $item['price']
            ]);

            $articles = [];

            foreach ($item['articles'] as $article) {
                $articles[$article['id']] = ['amount' => $article['amount']];
            }

            $product->articles()->attach($articles);
        }

        return 0;
    }
}
