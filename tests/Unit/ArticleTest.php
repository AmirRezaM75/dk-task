<?php

namespace Tests\Unit;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_casts_stock_to_number()
    {
        $article = Article::factory()->create();

        $this->assertIsInt($article->fresh()->stock);
    }
}
