@extends('layouts.app')
@section('title', 'Новини')

@section('content')
    <div class="row">
        @if (count($articles) == 0)
            <h4 class="card-article__title">
                Новин немає
            </h4>
        @endif

        @foreach ($articles as $article)
            <div class="col-xs-12 col-sm-4">
                <div class="card-article">
                    <a class="card-article__img" href="{{ route('articles.getArticle', $article->id) }}">
                        <img src="{{ asset('storage/' . $article->img) }}" />
                    </a>
                    <div class="card-article__content">
                        <h4 class="card-article__title">
                            <a href="{{ route('articles.getArticle', $article->id) }}">
                                {{ $article->title }}
                            </a>
                        </h4>

                    </div>
                    <div class="card-article__read-more ">
                        <a href="{{ route('articles.getArticle', $article->id) }}" class="btn btn-link btn-block">
                            Читати більше
                        </a>
                        <p class="card-article__date">{{ $article->date }}</i>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex">
            {!! $articles->links() !!}
        </div>
    </div>
@endsection
