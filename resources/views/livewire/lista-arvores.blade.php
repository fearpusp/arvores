@can('admin')
<div class="col-sm-11 container-fluid">
@else
<div class="col-sm-8 container-fluid">
@endcan
    <h4 class="mb-4 text-center"><img src="{{ asset('logo_fearp_arvore.png') }}"> Catálogo de árvores da FEA-RP </h4>
    <hr>

    <div class="container-fluid">
        <div class="row">
            <div class="col-1">
                <select class="form-control text-center" wire:model='perPage'>
                    <option value="25">25</option>
                    <option value="50" default>50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="col">
                <div wire:loading class="alert alert-info text-center"><i class="fas fa-spinner"></i> Carregando árvores...</div>
            </div>
            <div class="col-6">
                <div class="row">
                    <label class="form-group" for="search">Pesquisar</label>
                    <div class="col-6">
                        <input wire:model="search" type="text" class="form-control" id="search" autofocus>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <table class="table table-bordered table-sm table-striped" id="todas_arvores" style="width: 100%;">
        <thead>
            <tr>
                <th class="text-center">Código</th>
                <th class="text-center">Nome popular (<i>Nome científico</i>)</th>
                <th class="text-center">Porte</th>
                <th class="text-center">Localização</th>
                @can('admin')
                    <th class="text-center">Ocorrências</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($arvores as $arvore)
                <tr>
                    <td class="text-center">{{$arvore->codigo_unico}}</td>
                    <td class="text-center"><a href="{{ route('arvores.show', ['arvore' => $arvore->codigo_unico]) }}" class="btn btn-md btn-outline-info">{{$arvore->especie->nome_popular}} (<i>{{$arvore->especie->nome_cientifico}})</i></a>
                    @can('admin')
                        @if ($arvore->comentarios_nao_moderados->count() > 0)
                            <span class="text-center"><a href="{{ route('comentarios.edit', ['arvore' => $arvore]) }}" class="btn-sm btn-success"><small><i class="fas fa-exclamation"></i> Moderação</small></a></span>
                        @endif
                    @endcan
                    </td>
                    <td class="text-center">{{ ucfirst($arvore->porte) }}</td>
                    <td class="text-center"><small><a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-sm btn-primary"
                                    target="_blank"><i class="fa fa-map-marker-alt"></i>
                                    {{$arvore->latitude}}, {{$arvore->longitude}}</a></small>
                    </td>
                    @can('admin')
                        <td class="text-center"><a href="{{ route('ocorrencias.create', ['arvore' => $arvore]) }}" class="btn btn-sm btn-warning"><i class="fas fa-exclamation"></i> Registrar</a></td>
                        <td class="text-center"><a href="{{ route('arvores.edit', ['arvore' => $arvore]) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pen"></i></a></td>
                        <td class="text-center">
                            <form action="{{ route('arvores.destroy', ['arvore' => $arvore->id]) }} " method="post" id="form_delete">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Tem certeza?');" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($perPage)
        <div class="row justify-content-center">
            <span class="form-control col-1 text-center" style="border: 0;"> Total: {{ $arvores->total() }} &nbsp; </span>{{ $arvores->links() }}
        </div>
    @endif
</div>
