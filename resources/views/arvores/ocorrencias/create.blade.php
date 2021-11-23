@extends('layouts.app')

@section('content')
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Ocorrência para {{ $arvore->nome_popular }} ({{$arvore->codigo_unico}})</h4>
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
        <form class="form" action="{{ route('ocorrencias.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="arvore_id" value="{{ $arvore->id }}">
            <div class="row">
                <div class="col-3">
                    <label for="data_hora" class="control-label">Data/hora</label>
                    <input name="data_hora" class="form-control" value="{{ Carbon\Carbon::parse(now())->format('d/m/Y H:i:s') }}"/>
                </div>
                <div class="col-6">
                    <label for="tipo_ocorrencia" class="control-label">Tipo</label>
                    <select class="form-control" name="tipo_ocorrencia" autofocus>
                        <option></option>
                        @foreach ($tipos as $tipo)
                        <option value="{{ $tipo['id'] }}">{{ $tipo['descricao']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="arquivo" class="control-label">Arquivo
                    <input type="file" name="arquivo" accept="image/png, image/jpeg, image/jpg, application/pdf, application/zip">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('arvores.index') }}" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection