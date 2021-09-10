@extends('adminlte::page')

@section('title', 'Notícias')

@section('content_header')
<div class="container mb-4"><h1>Publicações</h1></div>
@stop

@section('content')

    <hr>
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif
    <div class='container' id='container_css'>
        <!--direcionar para create-->
        <a class="btn btn-primary mb-2" href="{{ route('posts.create') }}">Criar publicação</a>
    </div>
    <hr>

    <div class="container">
        @foreach ($posts as $post)
            <p>
                <h4>{{ $post->title }}</h4>
                <a class='btn btn-xs btn-primary mb-2' href="{{ route('posts.show', $post->id) }}">Visualizae</a>
                <a class='btn btn-xs btn-primary mb-2' href="{{ route('posts.edit', $post->id) }}">Editar</a>
                @include('admin.posts.reuse.destroy-post')
            </p>
        @endforeach

        @if(count($posts)==0)
        <p>Sem notícas publicadas</p>
        @endif

        @if (isset($filters))
            {{ $posts->appends($filters)->links() }}
            <!--appends com redicção any, para preservar o filtro de search na url para não bugar-->
        @else
            {{ $posts->links() }}
        @endif
    </div>
    <hr>
    @stop
