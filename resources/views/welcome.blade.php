@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Publicações</h1>
@stop

@section('content')
    @foreach ($posts as $post)
        @section('title', 'Notícias')
    @endforeach

    <hr>
    <div class="container">
        @foreach ($posts as $post)
            <p>
                {{ $post->title }}
                [
                <button><a href="{{ route('posts.show', $post->id) }}">Veja mais</a></button>
                ]
            </p>
        @endforeach

        <!--filtro de pesquisa-->
        @if (isset($filters))
            {{ $posts->appends($filters)->links() }}
            <!--appends com redicção any, para preservar o filtro de search na url para não bugar-->
        @else
            {{ $posts->links() }}
        @endif
    </div>
    <hr>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

