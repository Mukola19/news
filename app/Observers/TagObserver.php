<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Tag;

class TagObserver
{

    /**
     * Handle the Tag "created" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function created(Tag $tag)
    {

        $url = route('articles.getArticle', $tag->article_id);
        $articles =  Article::where('id', '!=', $tag->article_id)->get();

        foreach ($articles as $article) {
            $article->text = preg_replace("/\b" . $tag->name . "\b/iu", "<a href='$url'>$tag->name</a>", $article->text);
            $article->save();
        }
    }


    /**
     * Handle the Tag "deleted" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function deleted(Tag $tag)
    {

        $url = route('articles.getArticle', $tag->article_id);
        $articles =  Article::all();

        foreach ($articles as $article) {
            $article->text = str_replace("<a href='$url'>$tag->name</a>", $tag->name, $article->text);
            $article->save();
        }
    }
}
