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

    <h4 class="mb-4 text-center"><img src="{{ asset('logo_fearp_arvore.png') }}"> Concurso de Fotos </h4>
    <hr>
    <div class="col-sm-8 container-fluid justify-content-center">
        <div class="text-center">
            <p>Veja os principais itens no Edital deste concurso!</p>
        </div>
        <div class="text-left">
            <p>Acesse os links abaixo:</p>
            <ul>
                <li><a href="{{ route('lista_concurso') }}">Lista com árvores participantes</a></li>
                <li><a href="{{ route('arvores.mapa_concurso') }}">Mapa no Google coma as árvores participantes</a></li>
            </ul>
        </div>
    </div>
@endsection
@section('javascripts_bottom')
@endsection

