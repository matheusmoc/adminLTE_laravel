@extends('adminlte::page')

@section('title', "{$posts->title}")

@section('content_header')

@section('content')

<div class='container'>

<h1><strong>{{$posts->title}}</strong></h1>

<p>{!! $posts->content !!}</p>

<img src="{{url("storage/{$posts->image}")}}">

<br>
<br>
</div>

<!--o delete esteve aqui-->
@stop
