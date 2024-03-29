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
            <p><b><a href="{{ asset('edital_concurso_fotografia_2022.pdf') }}">Edital do concurso</b></a></p>
            <p><b><a href="{{ route('resultado') }}">Resultado do concurso</b></a></p>
        </div>
    </div>
@endsection
@section('javascripts_bottom')
@endsection

