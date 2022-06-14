<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $data = json_decode(file_get_contents($request->file('file')), true);

        Article::query()->upsert($data['articles'], 'id');
    }
}
