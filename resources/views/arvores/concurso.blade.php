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

    <h4 class="mb-4 text-center"><img src="{{ asset('logo_fearp_arvore.png') }}"> Concurso de Fotografias </h4>
    <hr>
    <div class="col-sm-8 container-fluid justify-content-center">
        <div class="jumbotron text-center" style="margin-bottom: 5px; margin-left: 2px; margin-right: 2px;">
            <p>O concurso de fotografia para o site "Árvores da FEA-RP" tem o objetivo de envolver a comunidade uspiana para contribuir com boas fotos para completar o catálogo existente no site.</p>
            <p>Os autores das três melhores fotografias serão premiados conforme regras do edital. Espera-se que esta ação também resulte no interesse da comunidade pela arborização e pelo cuidado com o meio ambiente.</p>
            <p>O prazo para envio das fotografias é até 05/08/2022.</p>
            <p>Acesse o <a href="{{ asset('edital_concurso_fotografia_2022.pdf') }}">Edital completo em PDF</a></p>
            <hr>
            <div class="text-left">
                <p>Acesse os links abaixo:</p>
                <ul>
                    <li><a href="{{ route('lista_concurso') }}">Lista com as árvores participantes</a></li>
                    <li><a href="{{ route('arvores.mapa_concurso') }}">Mapa no <i>Google</i> com as árvores participantes</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('javascripts_bottom')
@endsection

