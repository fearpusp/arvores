<?php

$admin = [
    [
        'text' => 'Lista completa',
        'url' => 'index-admin',
        'can' => 'admin',
    ],
    [
        'text' => 'Lista árvores mortas',
        'url' => 'index-mortas',
        'can' => 'admin',
    ],
    [
        'text' => 'Moderação de todos comentários',
        'url' => 'comentarios/todos',
        'can' => 'admin',
    ],
];
$arquivos = [
    [
        'text' => 'Gerar csv todas árvores',
        'url' => 'gerar-csv-completo',
        'can' => 'admin',
    ],
    [
        'text' => 'Gerar csv árvores concurso',
        'url' => 'gerar-csv-concurso',
        'can' => 'admin',
    ],
];

$menu_concurso = [
    [
        'text' => 'Apresentação',
        'url' => 'concurso',
    ],
    [
        'text' => 'Árvores do concurso',
        'url' => 'lista_concurso',
    ],
    [
        'text' => 'Mapa com as árvores do concurso',
        'url' => 'mapa_concurso',
    ],
    [
        'text' => 'Edital em PDF',
        'url' => 'edital_concurso_fotografia_2022.pdf',
    ],
    [
        'text' => 'Participantes',
        'url' => 'participantes_concurso',
    ],
    [
        'text' => 'Resultado',
        'url' => 'concurso/resultado',
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
        'text' => 'Lista árvores mortas',
        'url' => 'index-mortas',
    ],
    [
        'text' => 'Administrativo',
        'submenu' => $admin,
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
        'text' => 'Arquivos CSV',
        'submenu' => $arquivos,
        'can' => 'admin',
    ],
    [
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
