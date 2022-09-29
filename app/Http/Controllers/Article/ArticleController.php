<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends Controller
{

    /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::where('active', true)->latest()->paginate(10);

        foreach ($articles as $article) {
            $date = Carbon::parse($article->created_at)->format('H:i, d.m.y');
            $article->date = $date;
        }
        return view('articles.index', compact('articles'));
    }

    /**
     *
     * @return \Illuminate\View\View
     */
    public function getArticle($id)
    {
        $article = Article::where('id', $id)->first();

        $previous_id = Article::where('active', true)
            ->where('id', '<', $article->id)
            ->max('id');

        $next_id = Article::where('active', true)
            ->where('id', '>', $article->id)
            ->min('id');

        $next = Article::find($next_id);
        $previous = Article::find($previous_id);

        $date = Carbon::parse($article->created_at)->format('H:i, d.m.y');
        $article->date = $date;

        return view('articles.article', compact('article'))
            ->with('previous', $previous)
            ->with('next', $next);
    }
}
