<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspecieController extends Controller
{
    public function index()
    {
        $especies = Especie::all();

        return view('arvores.especies.index', compact('especies'));
    }

    public function create()
    {
        return view('arvores.especies.create');
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
            'nome_cientifico' => 'required',
            'nome_popular' => 'required',
        ], $messages);

        // Validação
        if ($validator->fails()) {
            return redirect()
                ->route('especies.create')->withErrors($validator)->withInput();
        }

        $especie = new Especie();
        $especie->nome_cientifico = $request->nome_cientifico;
        $especie->nome_popular = $request->nome_popular;
        $especie->save();
        return redirect()->route('especies.index')->with(['success' => 'Espécie cadastrada com sucesso!']);
    }
}
