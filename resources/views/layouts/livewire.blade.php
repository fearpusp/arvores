<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@section('title'){{ $title }}@show</title>

    <base href="{{ $app_url }}/">

    <link rel="canonical" href="https://github.com/uspdev/laravel-usp-theme">

    {{-- Incluindo todos os partials necessários para o theme --}}
    @include('laravel-usp-theme::partials.partials_loader')

    <!-- Estilos do tema e das bibliotecas internas -->
    @yield('styles_default')

    <!-- Estilos do skin -->
    @yield('skin_styles')

    <!-- Estilos da aplicação -->
    @yield('styles')
    @livewireStyles
</head>

<body>
    <div id="skin_header" class="{{$container}}"> {{-- Cria a barra de topo, em geral com o logo da unidade --}}
        @yield('skin_header')
    </div>

    <div id="skin_login_bar" class="{{$container}}"> {{-- Cria a barra de login/logout --}}
        @yield('skin_login_bar')
    </div>

    <div id="menu" class="{{$container}}"> {{-- Cria a barra de menus da aplicação --}}
        @yield('menu')
    </div>

    @livewire('lista-arvores')

    </div>

    <div id="skin_footer" class="{{$container}}"> {{-- Cria a barra do rodapé --}}
        @yield('skin_footer')
    </div>

    <!-- Bibliotecas js do tema e das bibliotecas internas -->
    @yield('javascripts_default')

    <!-- Bibliotecas js da aplicação -->
    @yield('javascripts_bottom')
    @livewireScripts

</body>

</html>

