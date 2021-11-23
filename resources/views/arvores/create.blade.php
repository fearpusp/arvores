@extends('layouts.app')

@section('content')
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Cadastrar árvore</h4>
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
        <form class="form" action="{{ route('arvores.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-3">
                    <label for="codigo_unico" class="control-label">Código único</label>
                    <input name="codigo_unico" class="form-control" autofocus/>
                </div>
            <!--/div>
            <div class="form-row"!-->
                <div class="col-6">
                    <label for="especie" class="control-label">Especie</label>
                    <select class="form-control" name="especie">
                        <option></option>
                        @foreach ($especies as $especie)
                        <option value="{{ $especie['id'] }}">{{ $especie['nome_popular']}} ({{ $especie['nome_cientifico'] }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="porte" class="control-label">Porte</label>
                    <select class="form-control" name="porte">
                        <option value="pequeno">Pequeno</option>
                        <option value="medio">Médio</option>
                        <option value="grande">Grande</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="latitude" class="control-label">Latitude</label>
                    <input name="latitude" class="form-control"/>
                </div>
                <div class="col">
                    <label for="longitude" class="control-label">Longitude</label>
                    <input name="longitude" class="form-control"/>
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="col text-center">
                    <label for="foto" class="control-label">Foto/imagem
                    <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg">
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
