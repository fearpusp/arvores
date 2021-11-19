@extends('layouts.app')

@section('content')
    <h4 class="text-center">Todas as árvores cadastradas</h4>
    <hr>
@php $count = 1; @endphp

    <div class="row">
    @foreach ($arvores as $arvore)
    <div class="col-4">
        <div class="card mb-4" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="/foto/{{$arvore->fotos->first()->id}}" alt="..." style="width: 9rem;">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ $arvore->nome_popular }}</strong></h5>
                    <p class="card-text">
                        Código: {{ $arvore->codigo_unico }}<br>
                        Nome científico: {{ $arvore->nome_cientifico }}<br>
                        Porte: {{ $arvore->porte }}<br>
                    </p>
                    <p class="card-text"><small class="text-muted">
                        <a href="https://www.google.com.br/maps/search/{{$arvore->latitude}},{{$arvore->longitude}}" class="btn btn-primary" target="_blank">Localização (GPS)</a>
</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>
    @if (($count % 3) == 0)
</div>
<div class="row">
    @endif
    @php $count++; @endphp
    @endforeach
</div>
@endsection
