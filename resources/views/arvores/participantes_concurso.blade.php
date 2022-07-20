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

    <h4 class="mb-4 text-center"><img src="{{ asset('logo_fearp_arvore.png') }}"> Participantes do Concurso </h4>
    <hr>
        <div class="col-sm-12 container-fluid justify-content-center">
            <div class="row">
                @foreach ($pessoas as $codpes => $dados)
                    <div class="card" style="margin-bottom: 5px; margin-left: 5px; margin-right: 5px; max-width: 30rem; padding: 10px;">
                        @php $total_arvores = count($dados['arvores']); @endphp
                        <h5 class="card-title text-center">{{ $dados['nome'] }}</h5>
                        <span class="card-subtitle text-center mb-2 text-muted">({{$total_arvores}} árvore(s))</span>
                        <div class="row" style="margin: 2px;">
                            @foreach ($dados['arvores'] as $codigo => $arvore)
                                <div class="card-body text-center" style="padding: 2px;">
                                    <a href="{{ route('arvores.show', ['arvore' => $codigo]) }}" class="btn btn-md btn-outline-info" style="border: 0;">
                                        <b>{{$arvore['nome_popular']}}</b> <small>({{$codigo}})</small></p>
                                    </a>
                               </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
@endsection
@section('javascripts_bottom')
@endsection

