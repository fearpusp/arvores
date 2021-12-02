@extends ('layouts.app')
@section ('content')
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

    <h4 class="mb-4 text-center">Catálogo de árvores da FEA-RP</h4>
    <hr>
    <table class="table table-bordered table-sm table-striped" id="todas_arvores" style="width: 100%;">
        <thead>
            <tr>
                <th class="text-center">Código</th>
                <th class="text-center">Nome popular</th>
                <th class="text-center">Nome científico</th>
                <th class="text-center">Porte</th>
                <th class="text-center">Localização</th>
                <th class="text-center">Visualizar</th>
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
                    <td>{{$arvore->codigo_unico}}</td>
                    <td>{{$arvore->especie->nome_popular}}</td>
                    <td><i>{{$arvore->especie->nome_cientifico}}</i></td>
                    <td>{{ ucfirst($arvore->porte) }}</td>
                    <td class="text-center"><small><a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-sm btn-primary"
                                    target="_blank"><i class="fa fa-map-marker-alt"></i>
                                    {{$arvore->latitude}}, {{$arvore->longitude}}</a></small>
                    </td>
                    <td class="text-center"><a href="{{ route('arvores.show', ['arvore' => $arvore->codigo_unico]) }}" class="btn-sm btn-info"><i class="fas fa-play"></i> Página</a></td>
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
@endsection
@section('javascripts_bottom')
<script>
    // https://datatables.net/extensions/fixedheader/examples/options/columnFiltering.html
    $(document).ready(function() {
        const table_arvores = $('#todas_arvores').DataTable({
            lengthMenu: [ [50, 100, 250, -1], [50, 100, 250, "Todas"] ],
            pageLength: 50,
            paging: true,
            ordering: false,
            order: [1, 'asc'],
        });
    });
</script>
@endsection
