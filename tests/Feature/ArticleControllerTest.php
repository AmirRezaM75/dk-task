<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_import_articles_using_json_file()
    {
        $content = file_get_contents(base_path('tests/stubs/articles.json'));

        $stub = UploadedFile::fake()->createWithContent('articles.json', $content);

        $this->post('api/articles', ['file' => $stub])
            ->assertStatus(200);

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
        $content = file_get_contents(base_path('tests/stubs/articles.json'));

        $stub = UploadedFile::fake()->createWithContent('articles.json', $content);

        $article = Article::factory()->create();

        $this->post('api/articles', ['file' => $stub]);

        $this->assertSame(12, $article->fresh()->stock);
    }
}
