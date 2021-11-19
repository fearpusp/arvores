<?php

namespace App\Http\Controllers;

use App\Models\Arvore;
use App\Models\Especie;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArvoreController extends Controller
{
    public function index()
    {
        $arvores = Arvore::all();

        return view('arvores.index', compact('arvores'));
    }

    public function create()
    {
        $especies = Especie::all();
        return view('arvores.create', compact('especies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'O campo :attribute deve estar preenchido.',
        ];

        // Componente responsável pela validação
        $validator = Validator::make($request->all(), [
            'codigo_unico' => 'required',
            'especie' => 'required',
            'porte' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:6048',
        ], $messages);

        // Validação
        if ($validator->fails()) {
            return redirect()
                ->route('arvores.create')->withErrors($validator)->withInput();
        }

        $especie = Especie::select('nome_cientifico', 'nome_popular')->find($request->especie);
        $arvore = new Arvore();
        $arvore->codigo_unico = $request->codigo_unico;
        $arvore->nome_cientifico = $especie->nome_cientifico;
        $arvore->nome_popular = $especie->nome_popular;
        $arvore->porte = $request->porte;
        $arvore->latitude = $request->latitude;
        $arvore->longitude = $request->longitude;
        $arvore->save();

        $foto = new Foto();
        $foto->arvore_id = $arvore->id;
        $foto->original_name = $request->file('foto')->getClientOriginalName();
        $foto->path = $request->file('foto')->store('./fotos');
        $foto->save();

        return redirect()->route('arvores.index')->with('success', 'Árvore cadastrada com sucesso!');
    }
}
