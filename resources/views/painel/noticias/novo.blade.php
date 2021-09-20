@extends('adminlte::page')

@section('title', 'Publicar Notícias')

<!--ckeditor-->
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/[version.number]/[distribution]/ckeditor.js"></script>

@section('content_header')

        <h2>Notícias</h2>

@section('content')
    <form action="{{ route('painel.store') }}" method="post" enctype="multipart/form-data">
        @include('painel.noticias.reutilizaveis.form')
    </form>
@endsection

@stop
