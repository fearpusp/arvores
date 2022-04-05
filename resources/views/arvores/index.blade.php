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

    <h4 class="mb-4 text-center"><img src="{{ asset('logo_fearp_arvore.png') }}"> Catálogo de árvores da FEA-RP </h4>
    <hr>
    @can('admin')
        <div>
    @else
        <div class="col-sm-12 container-fluid">
    @endcan
            <table id="todas_arvores">
                <div class="row">
            @foreach ($arvores as $arvore)
                <div class="col">
                <div class="card" style="width: 15rem;">
                    @if (count($arvore->fotos) > 0)
                        <img src="foto/{{$arvore->fotos->first()->id}}" style="width: 8rem;" class="rounded mx-auto d-block" alt="{{ $arvore->especie->nome_popular }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="{{ route('arvores.show', ['arvore' => $arvore->codigo_unico]) }}" class="btn btn-md btn-outline-info" style="border: 0;">
                                {{$arvore->especie->nome_popular}}<br>
                                (<i>{{$arvore->especie->nome_cientifico}})</i><br>
                               <small>Código: {{$arvore->codigo_unico}}</small>
                            </a>
                        </h5>
                        <p class="card-text text-center"><small>Porte: <b>{{ ucfirst($arvore->porte) }}</b></small></p>
                        <p class="text-center"><small><a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-sm btn-primary"
                                        target="_blank"><i class="fa fa-map-marker-alt"></i>
                                        {{$arvore->latitude}}, {{$arvore->longitude}}</a></small>
                        </p>
                   </div>
                </div>
                </div>
                    @can('admin')
                        @if ($arvore->comentarios_nao_moderados->count() > 0)
                            <span class="text-center"><a href="{{ route('comentarios.edit', ['arvore' => $arvore]) }}" class="btn-sm btn-success"><small><i class="fas fa-exclamation"></i> Moderação</small></a></span>
                        @endif
                    @endcan

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
            @endforeach
            </div>
            </div>
        </tbody>
    </table></div>
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
