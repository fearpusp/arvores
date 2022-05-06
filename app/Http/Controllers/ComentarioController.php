<?php

namespace App\Http\Controllers;

use App\Models\Arvore;
use App\Models\Comentario;
use App\Models\ComentarioFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    public function create(Arvore $arvore)
    {
        return view('arvores.comentarios.create', compact('arvore'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Seu comentário deve estar preenchido.',
            'min' => 'Seu comentário deve conter mais de 5 caracteres.',
        ];

        // Componente responsável pela validação
        $validator = Validator::make($request->all(), [
            'comentario' => 'required|min:5',
            'foto' => 'file|image|mimes:jpeg,png,jpg|max:24000000',
        ], $messages);

        // Validação
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comentario = new Comentario();
        $comentario->comentario = $request->comentario;
        $comentario->arvore_id = $request->arvore_id;
        $comentario->user_id = Auth::user()->id;
        $comentario->save();

        if (count($request->file())) {
            $comentario_foto = new ComentarioFoto();
            $comentario_foto->comentario_id = $comentario->id;
            $comentario_foto->original_name = $request->file('foto')->getClientOriginalName();
            $comentario_foto->path = $request->file('foto')->store('./comentario_fotos');
            $comentario_foto->save();
        }

        $arvore = Arvore::find($request->arvore_id);
        return redirect()->route('arvores.show', ['arvore' => $arvore->codigo_unico]);
    }

    public function edit(Arvore $arvore)
    {
        $comentarios = $arvore->comentarios_nao_moderados;
        return view('arvores.comentarios.edit', compact('arvore', 'comentarios'));
    }

    public function update(Request $request, Arvore $arvore)
    {
        if ($request && $arvore) {
            foreach ($request->aprovar as $id => $aprovado) {
                $comentario = Comentario::find($id);
                if ($aprovado == "sim") {
                    $comentario->publicar = true;
                    if (count($comentario->fotos) > 0) {
                        /* fazer resie (fit) da foto e salvar na pasta public */
                        $file = explode('/', $comentario->fotos->first()->path);
                        $file = $file[2];
                        $img_resize = \Image::make(storage_path("app/comentario_fotos/{$file}"));
                        $img_resize->fit(150);
                        $img_resize->save(public_path("img/comentarios/{$comentario->fotos->first()->id}.jpg"));
                    }
                } else if ($aprovado == "nao") {
                    $comentario->publicar = false;
                }
                $comentario->moderado = true;
                $comentario->save();
            }
            return redirect()->route('arvores.show', ['arvore' => $arvore->codigo_unico]);
        }
    }
}
