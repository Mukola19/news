<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.articles.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'unique:articles'],
            'text' => 'required',
            'img' => 'required',
        ]);
        $article = new Article();

        $article->title = $request->title;
        $article->text = $request->text;
        $article->active = $request->has('active');

        // saving the photo and writing the path to the model
        $article->img = $request->file('img')->store('articles');

        // create an array of tags
        $tags = explode(',', $request->tags);

        $notUniqueTags = Tag::whereIn('name', $tags)->get();

        // condition if we have non-unique tags
        if (count($notUniqueTags)) {
            $warningText = 'Ці тегі є не унікальні: ';
            foreach ($notUniqueTags as $notUniqueTag) {
                $warningText = $warningText . $notUniqueTag->name;
            }
            return back()->withInput()->with('warning', $warningText);
        }




        $url = $_SERVER['APP_URL'];

        $tagsAll = Tag::all();

        // add a link to the text
        foreach ($tagsAll as $tag) {
            $article->text = preg_replace("/\b" . $tag->name . "\b/i", "<a href='$url/articles/$tag->article_id'>$tag->name</a>", $article->text);
        }

        $article->save();

        // creating tags for the article
        if ($tags[0] !== '') {
            foreach ($tags as $tag) {
                $article->tags()->create(['name' => $tag]);
            }
        }

        return back()->with('success', 'Стаття була добавлена до бази даних');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {

        $tags = '';

        // converting tags to string
        foreach ($article->tags as $tag) {
            $tags = $tags . $tag->name . ',';
        }
        $article->tags = $tags;

        // removing html tags from the text
        $article->text = strip_tags($article->text);

        return view('admin.articles.form', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);

        $article->title = $request->title;
        $article->text = $request->text;
        $article->active = $request->has('active');

        // removing old photo and saving the photo and writing the path to the model
        if ($request->file('img')) {
            Storage::delete($article->img);
            $article->img = $request->file('img')->store('articles');
        }


        // create an array of tags
        $tags = explode(",", $request->tags);
        $notUniqueTags = Tag::where('article_id', '!=', $article->id)
            ->whereIn('name', $tags)->get();

        // condition if we have non-unique tags
        if (count($notUniqueTags)) {
            $warningText = 'Ці тегі є не унікальні: ';
            foreach ($notUniqueTags as $notUniqueTag) {
                $warningText = $warningText . $notUniqueTag->name;
            }
            return back()->withInput()->with('warning', $warningText);
        }


        $url = $_SERVER['APP_URL'];

        $tagsAll = Tag::all();

        // add a link to the text
        foreach ($tagsAll as $tag) {
            $article->text = preg_replace("/\b" . $tag->name . "\b/i", "<a href='$url/articles/$tag->article_id'>$tag->name</a>", $article->text);
        }


        $article->save();

        // removing old tags and creating tags for the article

        foreach ($article->tags as $tag) {
            $tag->delete();
        }

        if ($tags[0] !== '') {
            foreach ($tags as $tag) {
                $article->tags()->create(['name' => $tag]);
            }
        }

        return back()->with('success', 'Стаття була оновлена в базі даних');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        //removing article and tags
        foreach ($article->tags as $tag) {
            $tag->delete();
        }
        $article->delete();

        return back()->with('success', 'Стаття була видалина з бази даних');
    }
}
