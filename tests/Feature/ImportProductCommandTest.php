<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportProductCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_import_products_using_json_file()
    {
        $this->withoutExceptionHandling();
        $path = base_path('tests/stubs/products.json');

        Article::factory()->count(4)->create();

        $this->artisan("import:products $path");

        $this->assertDatabaseCount('products', 2);

        $this->assertDatabaseHas('products', [
            'id' => 2,
            'name' => 'Dining Chair',
            'price' => 1000,
        ]);

        $this->assertDatabaseHas('article_product', [
            'product_id' => 2,
            'article_id' => 5,
            'amount' => 4
        ]);
    }
}
