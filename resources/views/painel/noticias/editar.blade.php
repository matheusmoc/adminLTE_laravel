@extends('adminlte::page')

@section('title', "Editar Notícia: {$post->title}")

@section('content_header')

@section('content')

<h3>Editar Notícia: {{ $post->title }}</h3>

<form action="{{ route('painel.update', $post->id) }}" method="post"  enctype="multipart/form-data">
    <!--action deve ser feito em rota-->
    @method('PUT')
    <!--Cria um campo hidden para editar igual o 'DELETE'-->
    @include('painel.noticias.reutilizaveis.form')

    <script>
        DecoupledEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
</form>

@stop
