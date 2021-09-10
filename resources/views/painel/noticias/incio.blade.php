@extends('adminlte::page')

@section('title', "{$post->title}")

@section('content_header')

@section('content')

<div class='container'>

<h1><strong>{{$post->title}}</strong></h1>

<p>{!! $post->content !!}</p>

<img src= "{{url("storage/{$post->image}")}}">
<br>
<br>

</div>

<!--o delete esteve aqui-->
@stop
