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
    <table class="table table-bordered table-sm table-striped" id="todas_especies">
        <thead>
            <tr>
                <th>Nome popular</th>
                <th>Nome científico</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especies as $especie)
                <tr>
                    <td>{{$especie->nome_popular}}</td>
                    <td><i>{{$especie->nome_cientifico}}</i></td>
                    <td class="text-center"><a href="{{ route('especies.edit', ['especie' => $especie->id]) }}" class="btn-sm btn-secondary"><i class="fas fa-pen"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('javascripts_bottom')
<script>
    // https://datatables.net/extensions/fixedheader/examples/options/columnFiltering.html
    $(document).ready(function() {
        const table_arvores = $('#todas_especies').DataTable({
            lengthMenu: [ [50, 100, 250, -1], [50, 100, 250, "Todas"] ],
            pageLength: 50,
            orderCellsTop: true,
            order: [0, 'asc'],
        });
    });
</script>
@endsection
