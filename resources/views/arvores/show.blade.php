@extends('layouts.app')

@section('content')
    <style>
        .modal.show {
          display: flex !important;
          justify-content: center;
        }

        .modal-dialog {
          align-self: center;
          max-width: 80vw;
        }

        .modal-body {
            overflow-y: auto;
        }

        .responsive {
          width: 100%;
          max-width: 800px;
          height: auto;
          max-height: 700px;
        }
    </style>
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
                    <div class="col-3-sm" style="position: relative;" >
                        @if (count($arvore->fotos) > 0)
                            <img src="foto/{{$arvore->fotos->first()->id}}" alt="..." style="width: 20rem;" class="rounded img-thumbnail" data-toggle="modal" data-target="#foto_modal">
                            <i style="position: absolute; bottom: 1%; left: 89%; background-color: white; color: black;" class="fas fa-search-plus fa-2x" data-toggle="modal" data-target="#foto_modal"></i>
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
                    <h5>Histórico de Ocorrências
                        @can('admin')
                            <span class="text-center"><a href="{{ route('ocorrencias.create', ['arvore' => $arvore]) }}" class="btn-sm btn-warning"><i class="fas fa-exclamation"></i> Nova</a></span>
                        @endcan
                    </h5>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($ocorrencias as $ocorrencia)
                        <li class="list-group-item">{{ Carbon\Carbon::parse($ocorrencia->data_hora)->format('d/m/Y') }}: {{ $ocorrencia->tipo_ocorrencia->descricao }}
                        @if (count($ocorrencia->arquivos) > 0)
                            <small>- <a href="arquivos/{{ $ocorrencia->arquivos->first()->id }}">Anexo</a></small>
                        @endif
                        @can('admin')
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

        <div class="modal fade" id="foto_modal" tabindex="-1" role="dialog" aria-labelledby="foto_modal_label" aria-hidden="true">
          <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
            <div class="modal-content align-items-center">
              <div class="modal-body">
                @if (count($arvore->fotos) > 0)
                    <img class="rounded responsive" src="foto/{{$arvore->fotos->first()->id}}">
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
