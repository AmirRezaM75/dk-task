<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ImportArticleCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @var string Path to JSON stub */
    private $path;

    protected function setUp(): void
    {
        parent::setUp();

        $this->path = base_path('tests/stubs/articles.json');
    }

    /** @test */
    public function can_import_articles_using_json_file()
    {
        $this->artisan("import:articles $this->path");

        $this->assertFileExists(base_path('tests/stubs/articles.csv'));

        $this->assertDatabaseCount('articles', 4);

        $this->assertDatabaseHas('articles', [
            'id' => 1,
            'name' => 'leg',
            'stock' => 12,
        ]);
    }

    /** @test */
    public function it_updates_existing_articles()
    {
        $article = Article::factory()->create(['id' => 1]);

        $this->artisan("import:articles $this->path");

        $this->assertSame(12, $article->fresh()->stock);
    }

    protected function tearDown(): void
    {
        File::delete(base_path('tests/stubs/articles.csv'));

        parent::tearDown();
    }
}
