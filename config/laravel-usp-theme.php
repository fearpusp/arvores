<?php

$admin = [
    [
        'text' => 'Gerar csv todas árvores',
        'url' => '',
        'can' => 'admin',
    ],
    [
        'text' => 'Gerar csv árvores concurso',
        'url' => '',
        'can' => 'admin',
    ],
];

$menu_concurso = [
    [
        'text' => 'Árvores do concurso',
        'url' => 'concurso',
    ],
    [
        'text' => 'Mapa com as árvores do concurso',
        'url' => 'mapa_concurso',
    ],
];

$menu = [
    [
        'text' => '<i class="fas fa-home"></i> Início',
        'url' => '',
    ],
    [
        'text' => 'Lista completa',
        'url' => 'index',
    ],
    [
        'text' => 'Mapa com todas as árvores',
        'url' => 'mapa',
    ],
    [
        'text' => 'Concurso',
        'submenu' => $menu_concurso,
    ],
    [
        'text' => 'Lista completa (ADMINISTRATIVO)',
        'url' => 'index-admin',
        'can' => 'admin',
    ],
    [
        'text' => 'Nova árvore',
        'url' => 'create',
        'can' => 'admin',
    ],
    [
        'text' => 'Listar espécies',
        'url' => 'especies',
        'can' => 'admin',
    ],
    [
        'text' => 'Cadastrar espécie',
        'url' => 'especies/create',
        'can' => 'admin',
    ],
    [
        'text' => 'Admin',
        'submenu' => $admin,
    ],    [
        # este item de menu será substituido no momento da renderização
        'key' => 'menu_dinamico',
    ],
];


$right_menu = [
    [
        // menu utilizado para views da biblioteca senhaunica-socialite.
        'key' => 'senhaunica-socialite',
    ],
];


return [
    # valor default para a tag title, dentro da section title.
    # valor pode ser substituido pela aplicação.
    'title' => config('app.name'),

    # USP_THEME_SKIN deve ser colocado no .env da aplicação
    'skin' => env('USP_THEME_SKIN', 'uspdev'),

    # chave da sessão. Troque em caso de colisão com outra variável de sessão.
    'session_key' => 'laravel-usp-theme',

    # usado na tag base, permite usar caminhos relativos nos menus e demais elementos html
    # na versão 1 era dashboard_url
    'app_url' => config('app.url'),

    # login e logout
    'logout_method' => 'POST',
    'logout_url' => 'logout',
    'login_url' => 'login',

    # menus
    'menu' => $menu,
    'right_menu' => $right_menu,
];
