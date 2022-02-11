@extends('layouts.app')

@section('content')
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Comentário para {{ $arvore->especie->nome_popular }} ({{$arvore->codigo_unico}})</h4>
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
            <div class="row">
                <div class="col-2">
                    <label for="data_hora" class="control-label">Data</label>
                    <input name="data_hora" id="data_hora" class="form-control text-center" value="{{ Carbon\Carbon::parse(now())->format('d/m/Y') }}"/ readonly>
                </div>
                <div class="col-8">
                    <label for="comentario" class="control-label">Seu comentário</label>
                    <textarea class="form-control" name="comentario" autofocus> </textarea>
                </div>
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
