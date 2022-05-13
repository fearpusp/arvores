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
        <div class="pagination pagination-sm justify-content-center">
            <div class="col-sm-2 float-right">
                <form action="" class="form form-inline">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" name="q" placeholder="Informe parte dos nomes">
                    <div class="input-group-append" id="button-addon4">
                        <input type="submit" class="btn btn-sm btn-outline-primary" value="Buscar"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 container-fluid justify-content-center">
            <div class="row">
            @foreach ($arvores as $arvore)
                <div class="col-sm">
                    <div class="card" style="margin-bottom: 5px; margin-left: 2px; margin-right: 2px;">
                        @if (count($arvore->fotos) > 0)
                            <a href="{{ route('arvores.show', ['arvore' => $arvore->codigo_unico]) }}">
                                <img src="{{ asset('img/' . $arvore->fotos->first()->arvore_id . '.jpg') }}" class="rounded mx-auto d-block" alt="{{ $arvore->especie->nome_popular }}" style="margin-top: 5px; margin-bottom: 5px">
                            </a>
                        @endif
                        <div class="card-body" style="padding: 0;">
                            <h5 class="card-title text-center">
                                <a href="{{ route('arvores.show', ['arvore' => $arvore->codigo_unico]) }}" class="btn btn-md btn-outline-info" style="border: 0;">
                                    <b>{{$arvore->especie->nome_popular}}</b><br>
                                    <small>(<i>{{$arvore->especie->nome_cientifico}})</i><br>
                                    Código: {{$arvore->codigo_unico}}
                                    <p class="card-text text-center">Porte: {{ ucfirst($arvore->porte) }}</small></p>
                                </a>
                            </h5>
                            <p class="text-center"><small><a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-sm btn-primary"
                                            target="_blank"><i class="fa fa-map-marker-alt"></i>
                                            {{$arvore->latitude}}, {{$arvore->longitude}}</a></small>
                            </p>
                       </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

        <hr>
        <div class="pagination pagination-sm justify-content-center">
            {{ $arvores->links() }}
            <div class="col-sm-2 float-right">
                <form action="" class="form form-inline">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" name="q" placeholder="Informe parte dos nomes">
                    <div class="input-group-append" id="button-addon4">
                        <input type="submit" class="btn btn-sm btn-outline-primary" value="Buscar"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 text-center">
            <label style="border: 1px solid; padding: 0.25rem 0.5rem; font-size: .875rem; line-height: 1.5; border-radius: 0.2rem">Exibindo {{ $arvores->count() }} árvores do <b>total</b> de <b>{{ $arvores->total() }}</b></label>
        </div>
@endsection
@section('javascripts_bottom')
@endsection
