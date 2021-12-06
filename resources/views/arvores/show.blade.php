@extends('layouts.app')

@section('content')
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

    <h4 class="text-center">{{ $arvore->especie->nome_popular }}
        @can('admin')
            <small>&nbsp;<a href="{{ route('arvores.edit', ['arvore' => $arvore]) }}" class="btn-sm btn-secondary"><i class="fas fa-pen"></i> Editar árvore</a></small>
        @endcan
    </h4>
    <hr>
    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="row align-items-center justify-content-center">
                    <div class="col-3-sm">
                        @if (count($arvore->fotos) > 0)
                            <img src="foto/{{$arvore->fotos->first()->id}}" alt="..." style="width: 20rem;" class="rounded img-thumbnail">
                        @endif
                    </div>
                    <div class="col-9-sm">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $arvore->especie->nome_popular }}</strong></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><i>{{ $arvore->especie->nome_cientifico }}</i></h6>
                            <p class="card-text">
                                Código: {{ $arvore->codigo_unico }}<br>
                                Porte: {{ ucfirst($arvore->porte) }}<br>
                            </p>
                            <p class="card-text">
                                <a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-primary" target="_blank"><i class="fa fa-map-marker-alt"></i>  Localização (Maps)</a>
                            </p>
                            <p class="card-text">
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->gradient(59, 76, 66, 100, 200, 255, 'inverse_diagonal')->size(100)->generate(route('arvores.show', ['arvore' => $arvore->codigo_unico]))) !!} " class="rounded">
                            </p>
                            <br>
                            <div class="card-text">
                                <a href="{{ route('placa.show', ['arvore' => $arvore->codigo_unico]) }}" download="{{ $arvore->nome_popular }}" class="btn btn-sm btn-outline-primary">Download Placa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="card">
                <div class="card-header">
                    <h5>Histório de Ocorrências
                        @can('admin')
                            <span class="text-center"><a href="{{ route('ocorrencias.create', ['arvore' => $arvore]) }}" class="btn-sm btn-warning"><i class="fas fa-exclamation"></i> Nova</a></span>
                        @endcan
                    </h5>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($ocorrencias as $ocorrencia)
                        <li class="list-group-item">{{ Carbon\Carbon::parse($ocorrencia->data_hora)->format('d/m/Y') }}: {{ $ocorrencia->tipo_ocorrencia->descricao }}
                        @can('admin')
                            @if (count($ocorrencia->arquivos) > 0)
                                <small>- <a href="arvores/arquivos/{{ $ocorrencia->arquivos->first()->id }}">Anexo ({{ $ocorrencia->arquivos->first()->original_name }})</a></small>
                            @endif
                            <a href="{{ route('ocorrencias.edit', ['ocorrencia' => $ocorrencia->id]) }}" class="btn-sm btn-secondary"><i class="fas fa-pen"></i></a></td>
                        @endcan
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="container text-center">
        <br>
            <a href="{{ route('arvores.index') }}" class="btn btn-info">Todas as árvores</a>
        </div>
    </div>
@endsection
