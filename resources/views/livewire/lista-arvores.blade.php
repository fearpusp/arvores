<div>
    <div class="row justify-content-end">
        <div class="col-3">
            <label for="search">Pesquisar</label>
            <input wire:model="search" type="text" class="form-control" id="search" autofocus style="margin-bottom: 5px;">
        </div>
    </div>
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
    <div class="row justify-content-center">
        {{ $arvores->links() }}
    </div>
</div>
