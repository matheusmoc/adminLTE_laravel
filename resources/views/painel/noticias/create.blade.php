@extends('adminlte::page')

@section('title', 'Publicar Notícias')

<!--ckeditor-->
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/[version.number]/[distribution]/ckeditor.js"></script>

@section('content_header')


    <div class="container mb-4">
        <h2>Noticias</h2>
    </div>

@section('content')
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @include('admin.posts.reuse.form')
    </form>
    @endsection
@stop
