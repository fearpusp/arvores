@component('mail::message')
##  {{ $comentario->arvore->especie->nome_popular}} ({{ $comentario->arvore->codigo_unico}})
*{{ $comentario->arvore->especie->nome_cientifico}}*
@component('mail::panel')
    {{ $comentario->comentario }}

    Enviado por: {{ $comentario->user->name }} em {{ \Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y') }}
@endcomponent
@component('mail::button', ['url' => route('comentarios.edit', ['arvore' => $comentario->arvore]), 'color' => 'primary'])
    Moderar comentário
@endcomponent
@endcomponent

