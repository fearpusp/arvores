@extends('layouts.app')

@section('content')
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Comentário para {{ $arvore->especie->nome_popular }} ({{$arvore->codigo_unico}})</h4>
        <hr>
    </div>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- form start -->
            <form class="form" action="{{ route('comentarios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="arvore_id" value="{{ $arvore->id }}">
                <div class="card">
                    <div class="card-header">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <input name="data_hora" id="data_hora" class="form-control text-center" style="background-color: white; border: 0;" value="{{ Carbon\Carbon::parse(now())->format('d/m/Y') }}"/ readonly>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <label for="comentario" class="control-label">Seu comentário</label>
                            <textarea class="form-control" name="comentario" autofocus required rows="4"></textarea>
                            <br>
                            <div class="form-row">
                                <div class="col text-center">
                                    <label for="foto" class="control-label">Foto/imagem <small>(até 20MB)</small></label>
                                    <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg">
                                </div>
                            </div>
                            </div>
                        <hr>
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">Salvar comentário</button>
                            <a href="{{ route('arvores.index') }}" class="btn btn-default">Cancelar</a>
                        </div>

                    </div>
                </div>
        </div>
        </form>
    </div>
@endsection
