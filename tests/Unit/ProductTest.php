<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_consists_of_many_articles()
    {
        $articles = Article::factory()->count(3)->create();

        $product = Product::factory()->create();

        $product->articles()->attach($articles);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $product->articles);

        $this->assertInstanceOf(Article::class, $product->articles[0]);
    }
}
