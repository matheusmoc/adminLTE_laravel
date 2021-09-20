@extends('adminlte::page')

@section('title', 'Notícia')

@section('content_header')
    <h1>Notícias</h1>
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
        <a class="btn btn-primary mb-2" href="{{ route('painel.novo') }}">Criar publicação</a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listagem</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Título</th>
                                            <th>Data e hora cadastro</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>
                                                    <div>
                                                       {{$post->updated_at}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class='row'>
                                                        <a class='btn btn-primary ml-1'
                                                            href="{{ route('painel.show', $post->id) }}">Visualizar</a>
                                                        <a class='btn btn-primary ml-1'
                                                            href="{{ route('painel.editar', $post->id) }}">Editar</a>
                                                        @include('painel.noticias.reutilizaveis.excluir')
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if (count($posts) == 0)
                                    <p>
                                    <h2>Sem notícias publicadas</h2>
                                    </p>
                                @endif

                                <!--FILTRO DE PESQUISA-->
                                @if (isset($filters))
                                    {{ $posts->appends($filters)->links() }}
                                    <!--appends com redicção any, para preservar o filtro de search na url para não bugar-->
                                @else
                                    {{ $posts->links() }}
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1
                                    to 10 of 57 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="example2_previous"><a
                                                href="#" aria-controls="example2" data-dt-idx="0" tabindex="0"
                                                class="page-link">Previous</a></li>
                                        <li class="paginate_button page-item active"><a href="#" aria-controls="example2"
                                                data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                        <li class="paginate_button page-item next" id="example2_next"><a href="#"
                                                aria-controls="example2" data-dt-idx="7" tabindex="0"
                                                class="page-link">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@stop
