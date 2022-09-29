@extends('layouts.app')
@section('title', 'Новини')



@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ URL::previous() }}" class="s text-primary">Назад</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
        </ol>
    </nav>
    <div class="article">
        <h2 class="fw-bolder mb-1">{{ $article->title }}</h2>
        <div class="text-muted fst-italic mb-3">Створено {{ $article->date }}</div>
        <div class="d-flex flex-column">
            <div>
                <img src="{{ asset('storage/' . $article->img) }}" height="600" alt="">
            </div>
            <div class=" d-flex flex-column justify-contents-center">
                <div class="mt-5 w-50 ">
                    <p class="fs-6 mb-4">{!! $article->text !!}</p>
                </div>
            </div>
        </div>

    </div>

    <ul class="pagination w-100 d-flex justify-content-between mt-3">
        @if ($previous)
            <li class="page-item"><a class="page-link"
                    href="{{ route('articles.getArticle', $previous->id) }}">Попередня</a>
            </li>
        @endif
        <div></div>
        @if ($next)
            <li class="page-item"><a class="page-link" href="{{ route('articles.getArticle', $next->id) }}">Наступна</a>
            </li>
        @endif

    </ul>

@endsection
