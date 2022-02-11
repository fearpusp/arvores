@extends('layouts.app')

@section('content')
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Moderação de Comentários para {{ $arvore->especie->nome_popular }} ({{$arvore->codigo_unico}})</h4>
        <hr>
    </div>

    <!-- Mensagem de retorno que o documento foi inserido com sucesso -->
    @if (session()->has('success'))
    <div class="alert alert-success" id="div-sucesso">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session()->get('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container-fluid">
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form" action="{{ route('comentarios.store') }}" method="POST">
            @csrf
            <input type="hidden" name="arvore_id" value="{{ $arvore->id }}">
            <div>
                <table class="table table-bordered table-sm table-striped" id="todas_arvores" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">Data</th>
                            <th class="text-center">Usuário</th>
                            <th class="text-center">Comentário</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form>
                        @foreach ($comentarios as $comentario)
                            <tr>
                                <td class="text-center">{{ Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y') }}</td>
                                <td class="text-center">{{$comentario->user->name}}</td>
                                <td class="text-center">{{$comentario->comentario}}</td>
                                <td class="text-center">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="aprovar{{$comentario->id}}" name="aprovar" class="custom-control-input">
                                      <label class="custom-control-label" for="customRadio1">Aprovar</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="recusar{{$comentario->id}}" name="aprovar" class="custom-control-input">
                                      <label class="custom-control-label" for="customRadio2">Recusar</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </form>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Salvar comentário</button>
                    <a href="{{ route('arvores.index') }}" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection

