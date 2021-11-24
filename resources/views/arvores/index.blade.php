@extends ('layouts.app')
@section ('content')
<div class="container sm-8">
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

    <h4 class="mb-4 text-center">Todas as árvores cadastradas</h4>
    <hr>
    <table class="table table-bordered table-sm table-striped" id="logs">
        <thead>
            <tr>
                <th class="text-center">Código</th>
                <th class="text-center">Nome popular</th>
                <th class="text-center">Nome científico</th>
                <th class="text-center">Porte</th>
                <th class="text-center">Localização</th>
                <th class="text-center">Visualizar</th>
                @can('admin')
                <th>Ocorrências</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($arvores as $arvore)
                <tr>
                    <td>{{$arvore->codigo_unico}}</td>
                    <td>{{$arvore->nome_popular}}</td>
                    <td><i>{{$arvore->nome_cientifico}}</i></td>
                    <td>{{ ucfirst($arvore->porte) }}</td>
                    <td class="text-center"><a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-primary"
                                    target="_blank"><i class="fa fa-map-marker-alt"></i>
                                    {{$arvore->latitude}}, {{$arvore->longitude}}</a>
                    </td>
                    <td class="text-center"><a href="{{ route('arvores.show', ['arvore' => $arvore]) }}" class="btn btn-info"><i class="fas fa-play"></i> Página</a></td>
                    @can('admin')
                        <td class="text-center"><a href="{{ route('ocorrencias.create', ['arvore' => $arvore]) }}" class="btn btn-warning"><i class="fas fa-exclamation"></i> Registrar</a></td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('javascripts_bottom')
<script>
    // https://datatables.net/extensions/fixedheader/examples/options/columnFiltering.html
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#logs thead tr')
        .clone(true)
        const table = $('#logs').DataTable({
        lengthMenu: [ [50, 100, 250, -1], [50, 100, 250, "Todos"] ],
        pageLength: 50,
        orderCellsTop: true,
        order: [1, 'asc'],
        fixedHeader: true,
        initComplete: function () {
            const api = this.api();
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // On every keypress in this input
                    $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();

                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();

                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });

    });
</script>
@endsection
