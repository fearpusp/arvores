<?php

namespace App\Http\Controllers;

use App\Models\Arvore;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function create(Arvore $arvore)
    {
        return view('arvores.comentarios.create', compact('arvore'));
    }

    public function store(Request $request)
    {
        $comentario = new Comentario();
        $comentario->comentario = $request->comentario;
        $comentario->arvore_id = $request->arvore_id;
        $comentario->user_id = Auth::user()->id;
        $comentario->save();

        $arvore = Arvore::find($request->arvore_id);
        return redirect()->route('arvores.show', ['arvore' => $arvore->codigo_unico]);
    }

    public function edit(Arvore $arvore)
    {
        $comentarios = $arvore->comentarios;
        return view('arvores.comentarios.edit', compact('arvore', 'comentarios'));
    }
}
