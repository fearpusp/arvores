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

        #social-links ul{
            /*padding-left: 0;*/
            padding: 0;
        }

         #social-links ul li {
            display: inline-block;
        }

        #social-links ul li a {
            padding: 6px;
            /*border: 1px solid #ccc;
            border-radius: 5px;*/
            margin: 1px;
            font-size: 25px;

    </style>
    <div class="row justify-content-md-center">
        @if (session()->has('success'))
            <div class="alert alert-success text-center col-sm-6" id="div-sucesso">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>{{ session()->get('success') }}</b>
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
    </div>

    <h4 class="text-center">{{ $arvore->especie->nome_popular }}
        @can('admin')
            <small>&nbsp;<a href="{{ route('arvores.edit', ['arvore' => $arvore]) }}" class="btn-sm btn-secondary"><i class="fas fa-pen"></i> Editar árvore</a></small>
            <small class="text-center"><a href="{{ route('comentarios.edit', ['arvore' => $arvore]) }}" class="btn-sm btn-success"> Acessar Moderação</a></small>
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
                            <div class="card-text text-center">
                                <p><a href="{{ route('placa.show', ['arvore' => $arvore->codigo_unico]) }}" download="{{ $arvore->nome_popular }}" class="btn btn-sm btn-outline-primary">Download Placa</a></p>
                                <p><div class="text-center">
                                    {!! $links !!}
                                </div></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="card">
                <div class="card-header">
                    <h5>Histórico de Ocorrências <small>(Uso interno)</small>
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
            <hr>
            <div class="card">
                <div class="card-header">
                    <h5>Comentários
                        @can('admin')
                            @if ($comentarios_nao_moderados->count() > 0)
                                <span class="text-center"><a href="{{ route('comentarios.edit', ['arvore' => $arvore]) }}" class="btn-sm btn-success"><i class="fas fa-exclamation"></i> Moderação</a></span>
                            @endif
                        @endcan
                        @guest
                            <span class="text-right"><small><a href="{{ route('login') }}">(Aberto para comunidade USP - Faça login para comentar)</a></small></span>
                        @endguest
                        @auth
                            @can('user')
                               <span class="text-center"><a href="{{ route('comentarios.create', ['arvore' => $arvore]) }}" class="btn-sm btn-warning"><i class="fas fa-exclamation"></i> Novo</a></span>
                            @endcan
                        @endauth
                    </h5>
                </div>
                    @foreach ($comentarios as $comentario)
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                @if (count($comentario->fotos) > 0)
                                    <div class="row">
                                        <div class="col-sm-2" style="padding-right: 0px;">
                                            <img src="{{ asset('img/comentarios/' . $comentario->fotos->first()->id . '.jpg') }}" class="img-thumbnail rounded" data-toggle="modal" width data-target="#foto_modal_{{$comentario->fotos->first()->id}}"></td>
                                        </div>
                                        <div class="col-sm-10" style="padding-left: 0px;">
                                          <div class="card-body" style="padding: 10px;">
                                            <h6 class="card-subtitle mb-2 text-muted"><small>{{ $comentario->user->name }} em {{ Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y') }}</small></h6>
                                            <hr style="margin: 2px;">
                                            <p class="card-text">{{ $comentario->comentario }}</p>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="foto_modal_{{$comentario->fotos->first()->id}}" tabindex="-1" role="dialog" aria-labelledby="foto_modal_label" aria-hidden="true">
                                      <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
                                        <div class="modal-content align-items-center">
                                          <div class="modal-body">
                                            @if (count($comentario->fotos) > 0)
                                                <img class="rounded responsive" src="comentario_foto/{{$comentario->fotos->first()->id}}" style="width: 30rem;">
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                @else
                                      <div class="card-body" style="padding: 10px;">
                                        <h6 class="card-subtitle mb-2 text-muted"><small>{{ $comentario->user->name }} em {{ Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y') }}</small></h6>
                                        <hr style="margin-top: 2px; margin-bottom: 5px">
                                        <p class="card-text">{{ $comentario->comentario }}</p>
                                      </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
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
@section('javascripts_bottom')
@endsection
