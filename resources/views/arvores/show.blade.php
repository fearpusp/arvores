@extends('layouts.app')

@section('content')
    <h4 class="text-center">{{ $arvore->nome_popular }}</h4>
    <hr>
    <!--div class="container-fluid"-->
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-sm">
                        <img src="foto/{{$arvore->fotos->first()->id}}" alt="..." style="width: 20rem;">
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $arvore->nome_popular }}</strong></h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $arvore->nome_cientifico  }}</h6>
                            <p class="card-text">
                                Código: {{ $arvore->codigo_unico }}<br>
                                Porte: {{ ucfirst($arvore->porte) }}<br>
                            </p>
                            <p class="card-text">
                                <a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-primary" target="_blank"><i class="fa fa-map-marker-alt"></i>  Localização (Maps)</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('arvores.index') }}" class="btn btn-info">Todas as árvores</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
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
                        <li class="list-group-item">{{ Carbon\Carbon::parse($ocorrencia->data_hora)->format('d/m/Y H:i:s') }}: {{ $ocorrencia->tipo_ocorrencia }}
                        @can('admin')
                            @if (count($ocorrencia->arquivos) > 0)
                            - <a href="arvores/arquivos/{{ $ocorrencia->arquivos->first()->id }}">Anexo ({{ $ocorrencia->arquivos->first()->original_name }})</a>
                            @endif
                        @endcan
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
