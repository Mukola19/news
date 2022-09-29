@extends('layouts.admin')

@section('title', 'Admin')


@section('content')
    <div class="container-fluid">
        <div class="row mb-3 pt-3">
            <div class="col-sm-6">
                <h1 class="m-0">Всі статті</h1>
            </div>

        </div>
        <div class="card">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Назва статті</th>
                            <th>Тегі</th>
                            <th>Активна</th>
                            <th style="width: 40px"> Дії</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>
                                    <div class="d-flex align-content-center">
                                        @foreach ($article->tags as $tag)
                                            <p class="badge badge-primary mr-1" style="font-size: 14px"> {{ $tag->name }}
                                            </p>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    {{ $article->active ? 'Так' : 'Ні' }}
                                </td>

                                <td>
                                    <div class="d-flex ">

                                         <a href="{{ route('articles.getArticle', $article) }}" class="btn btn-success mr-2">
                                            <i class="fas fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-delete" type="submit">
                                                <i class=" fas fa-regular fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
