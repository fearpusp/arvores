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
        <div class="col-sm-12 container-fluid">
            <div class="row">
            @foreach ($arvores as $arvore)
                <div class="col">
                <div class="card" style="width: 18rem;">
                    @if (count($arvore->fotos) > 0)
                        <img src="foto/{{$arvore->fotos->first()->id}}" style="width: 8rem;" class="rounded mx-auto d-block" alt="{{ $arvore->especie->nome_popular }}">
                    @endif
                    <div class="card-body">
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
        </tbody>
@endsection
@section('javascripts_bottom')
@endsection
