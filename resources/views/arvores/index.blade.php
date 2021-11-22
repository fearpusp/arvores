@extends ('layouts.app')
@section ('content')
<div class="container sm-8">
    <h4 class="mb-4 text-center">Todas as espécies cadastradas</h4>
    <hr>
    <table class="table table-bordered table-sm table-striped" id="logs">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome popular</th>
                <th>Nome científico</th>
                <th>Porte</th>
                <th>Localização</th>
                <th>Visualizar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arvores as $arvore)
                <tr>
                    <td>{{$arvore->codigo_unico}}</td>
                    <td>{{$arvore->nome_popular}}</td>
                    <td>{{$arvore->nome_cientifico}}</td>
                    <td>{{$arvore->porte}}</td>
                    <td><a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-primary"
                                    target="_blank"><i class="fa fa-map-marker-alt"></i>
                                    {{$arvore->latitude}}, {{$arvore->longitude}}</a>
                    </td>
                    <td><a href="{{ route('arvores.show', ['arvore' => $arvore]) }}" class="btn btn-info"><i class="fas fa-play"></i> Informações</a></td>
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
