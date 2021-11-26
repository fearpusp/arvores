@extends('layouts.app')

@section('content')
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Ocorrência para {{ $ocorrencia->arvore->especie->nome_popular }} ({{$ocorrencia->arvore->codigo_unico}})</h4>
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
        <form class="form" action="{{ route('ocorrencias.update', ['ocorrencia' => $ocorrencia->id]) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('patch')
            <input type="hidden" name="arvore_id" value="{{ $ocorrencia->arvore->id }}">
            <div class="row">
                <div class="col-2">
                    <label for="data_hora" class="control-label">Data</label>
                    <input name="data_hora" id="data_hora" class="form-control text-center" value="{{ Carbon\Carbon::parse(now())->format('d/m/Y') }}"/>
                </div>
                <div class="col-6">
                    <label for="tipo_ocorrencia" class="control-label">Tipo</label>
                    <select class="form-control" name="tipo_ocorrencia" autofocus>
                        <option></option>
                        @foreach ($tipos as $tipo)
                            @if ($tipo->id == $ocorrencia->tipo_ocorrencia_id)
                                <option value="{{ $tipo['id'] }}" selected>{{ $tipo['descricao']}}</option>
                            @else
                                <option value="{{ $tipo['id'] }}">{{ $tipo['descricao']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="imagem" class="control-label">Arquivo cadastrado</label>
                    @if (count($ocorrencia->arquivos) > 0)
                        <a href="arvores/arquivos/{{ $ocorrencia->arquivos->first()->id }}">{{ $ocorrencia->arquivos->first()->original_name }}</a>
                        <input type="hidden" name="arquivo_anterior_id" value="{{ $ocorrencia->arquivos->first()->id }}">
                        <br><br>
                    @else
                        <p class="text-center">Sem arquivo</p>
                    @endif
                </div>

                <div class="col-4">
                    <br>
                    <label for="arquivo" class="control-label">Enviar novo Arquivo<p><small> o anterior será substituído</small></p></label>
                    <input type="file" name="arquivo" accept="image/png, image/jpeg, image/jpg, application/pdf, application/zip">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('arvores.show', ['arvore' => $ocorrencia->arvore_id]) }}" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('javascripts_bottom')
<script>
    $("#data_hora").datepicker({
        autoclose: true,
        todayHighliht: true,
        dateFormat: 'dd/mm/yy',
        maxDate: '0',
    });
</script>
@endsection

