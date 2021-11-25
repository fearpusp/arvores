<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Arvore;
use App\Models\Ocorrencia;
use App\Models\TipoOcorrencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OcorrenciaController extends Controller
{
    public function index()
    {
        $arvores = Arvore::all();
        return view('arvores.ocorrencias.index', compact('arvores'));
    }

    public function create(Arvore $arvore)
    {
        $tipos = TipoOcorrencia::all();
        return view('arvores.ocorrencias.create', compact('arvore', 'tipos'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'O campo :attribute deve estar preenchido.',
            'before_or_equal' => 'A data não pode ser futura',
            'date_format' => 'A data deve ser no formato dd/mm/yyyy',
        ];

        // Componente responsável pela validação
        //'data_hora' => 'required|date|max:' . date('d/m/Y'),
        $validator = Validator::make($request->all(), [
            'data_hora' => 'required|date_format:d/m/Y|before_or_equal:today',
            'tipo_ocorrencia' => 'required',
        ], $messages);

        // Validação
        if ($validator->fails()) {
            return redirect()
                ->route('ocorrencias.create', ['arvore' => $request->arvore_id])->withErrors($validator)->withInput();
        }

        $data_hora = Carbon::createFromFormat('d/m/Y', $request->data_hora);
        $tipo_ocorrencia = TipoOcorrencia::select('descricao')->find($request->tipo_ocorrencia);
        $ocorrencia = new Ocorrencia();
        $ocorrencia->data_hora = $data_hora->format('Y-m-d');
        $ocorrencia->tipo_ocorrencia = $tipo_ocorrencia->descricao;
        $ocorrencia->arvore_id = $request->arvore_id;
        $ocorrencia->save();

        if (count($request->file())) {
            $arquivo = new Arquivo();
            $arquivo->ocorrencia_id = $ocorrencia->id;
            $arquivo->original_name = $request->file('arquivo')->getClientOriginalName();
            $arquivo->path = $request->file('arquivo')->store('./arquivos');
            $arquivo->save();
        }

        return redirect()->route('arvores.index')->with(['success' => 'Ocorrência cadastrada com sucesso!']);
    }
}
