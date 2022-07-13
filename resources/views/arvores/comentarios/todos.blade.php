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
    <div class="container sm-4">
        <h4 class="mb-4 text-center">Moderação de Comentários</h4>
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
        <form class="form" action="{{ route('comentarios.updateTodos') }}" method="POST">
            @csrf
            <div>
                <table class="table table-bordered table-sm table-striped" id="todos_comentarios" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">Árvore</th>
                            <th class="text-center">Data</th>
                            <th class="text-center">Horário</th>
                            <th class="text-center">Usuário</th>
                            <th class="text-center">Comentário</th>
                            <th class="text-center">Foto/imagem</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comentarios as $comentario)
                            <tr>
                                <input type="hidden" value="{{$comentario->arvore->id}}" name="arvore_id">
                                <td class="text-center"><a target="_blank" href="{{ route('arvores.show', ['arvore' => $comentario->arvore->codigo_unico]) }}">{{$comentario->arvore->codigo_unico}} - {{$comentario->arvore->especie->nome_popular}} <i>({{$comentario->arvore->especie->nome_cientifico}})</i></td>
                                <td class="text-center">{{ Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y') }}</td>
                                <td class="text-center">{{ Carbon\Carbon::parse($comentario->created_at)->format('H:i:s') }}</td>
                                <td class="text-center">{{$comentario->user->name}} ({{ $comentario->user->codpes }})</td>
                                <td class="text-center">{{$comentario->comentario}}</td>
                                <td class="text-center">
                                    @if (count($comentario->fotos) > 0)
                                        <img src="comentario_foto/{{$comentario->fotos->first()->id}}" style="width: 5rem;" class="rounded img-thumbnail" data-toggle="modal" data-target="#foto_modal_{{$comentario->fotos->first()->id}}"></td>
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
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="aprovar{{$comentario->id}}" name="aprovar[{{$comentario->id}}]" value="sim" class="custom-control-input">
                                        <label class="custom-control-label" for="aprovar{{$comentario->id}}">Aprovar</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="recusar{{$comentario->id}}" name="aprovar[{{$comentario->id}}]" value="nao" class="custom-control-input">
                                        <label class="custom-control-label" for="recusar{{$comentario->id}}">Recusar</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Salvar moderação</button>
                    <a href="{{ route('arvores.index') }}" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('javascripts_bottom')
<script>
    // https://datatables.net/extensions/fixedheader/examples/options/columnFiltering.html
    $(document).ready(function() {
        const table_comentarios = $('#todos_comentarios').DataTable({
            lengthMenu: [ [50, 100, 250, -1], [50, 100, 250, "Todas"] ],
            pageLength: 50,
        });
    });
</script>
@endsection

