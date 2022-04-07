@extends('layouts.app')

@section('content')
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Editar árvore ({{ $arvore->especie->nome_popular }})</h4>
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
        <form class="form" action="{{ route('arvores.update', ['arvore' => $arvore]) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('patch')
            <div class="row">
                <div class="col-3">
                    <label for="codigo_unico" class="control-label">Código único</label>
                    <input name="codigo_unico" class="form-control" value="{{ $arvore->codigo_unico }}" readonly/>
                </div>
            <!--/div>
            <div class="form-row"!-->
                <div class="col-6">
                    <label for="especie" class="control-label">Especie</label>
                    <select class="form-control" name="especie" autofocus>
                        @foreach ($especies as $especie)
                            @if ($especie['id'] == $arvore->especie_id))
                                <option value="{{ $especie['id'] }}" selected>{{ $especie['nome_popular']}} ({{ $especie['nome_cientifico'] }})</option>
                            @else
                                <option value="{{ $especie['id'] }}">{{ $especie['nome_popular']}} ({{ $especie['nome_cientifico'] }})</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="porte" class="control-label">Porte</label>
                    <select class="form-control" name="porte">
                        @if ($arvore->porte == "pequeno")
                            <option value="pequeno" selected>Pequeno</option>
                        @else
                            <option value="pequeno">Pequeno</option>
                        @endif
                        @if ($arvore->porte == "médio")
                            <option value="médio" selected>Médio</option>
                        @else
                            <option value="médio">Médio</option>
                        @endif
                        @if ($arvore->porte == "grande")
                            <option value="grande" selected>Grande</option>
                        @else
                            <option value="grande">Grande</option>
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="latitude" class="control-label">Latitude</label>
                    <input name="latitude" class="form-control" value="{{ $arvore->latitude }}"/>
                </div>
                <div class="col">
                    <label for="longitude" class="control-label">Longitude</label>
                    <input name="longitude" class="form-control" value="{{ $arvore->longitude }}"/>
                </div>
                <div class="col-3">
                    <label for="imagem" class="control-label">Foto cadastrada</label>
                    @if (count($arvore->fotos) > 0)
                        <img name="imagem" src="foto/{{ $arvore->fotos->first()->id }}" width="100px" class="rounded">
                        <input type="hidden" name="foto_anterior_id" value="{{ $arvore->fotos->first()->id }}">
                        <br><br>
                    @else
                        <p class="text-center">Sem foto</p>
                    @endif
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="col text-center">
                    <label for="foto" class="control-label">Enviar nova Foto<p><small> a imagem anterior será substituída</small></p></label>
                    <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-default">Cancelar</a>
                </div>
            </div>

        </form>
    </div>
@endsection
