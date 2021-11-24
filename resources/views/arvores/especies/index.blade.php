@extends ('layouts.app')
@section ('content')
<div class="container sm-4">
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

    <h4 class="mb-4 text-center">Todas as espécies cadastradas</h4>
    <hr>
    <table class="table table-bordered table-sm table-striped" id="logs">
        <thead>
            <tr>
                <th>Nome popular</th>
                <th>Nome científico</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especies as $especie)
                <tr>
                    <td>{{$especie->nome_popular}}</td>
                    <td><i>{{$especie->nome_cientifico}}</i></td>
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
        .addClass('filters')
        .appendTo('#logs thead');

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
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');

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
