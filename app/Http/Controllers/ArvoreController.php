<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Arvore;
use App\Models\Comentario;
use App\Models\Especie;
use App\Models\Foto;
use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArvoreController extends Controller
{
    public function inicio()
    {
        \UspTheme::activeUrl('');
        return view('arvores.inicio');
    }

    public function index(Request $request)
    {
        \UspTheme::activeUrl('index');

        $search = $request->input('q');
        if ($search) {
            $arvores = Arvore::query()->select('arvores.id', 'especie_id', 'latitude', 'longitude', 'porte', 'codigo_unico')
                ->with('especie')
                ->join('especies', 'especies.id', '=', 'arvores.especie_id')
                ->where('especies.nome_popular', 'ilike', "%{$search}%")
                ->orWhere('especies.nome_cientifico', 'ilike', "%{$search}%")
                ->inRandomOrder()
                ->paginate(50);

            $arvores->append(['q' => $search]);
        } else {
            $arvores = Arvore::query()->select('arvores.id', 'especie_id', 'latitude', 'longitude', 'porte', 'codigo_unico')
                ->with('especie')
                ->join('especies', 'especies.id', '=', 'arvores.especie_id')
                ->inRandomOrder()
                ->paginate(50);
        }

        return view('arvores.index', compact('arvores'));
    }

    public function indexAdmin()
    {
        \UspTheme::activeUrl('index-admin');

        $arvores = Arvore::query()->select('arvores.id', 'especie_id', 'latitude', 'longitude', 'porte', 'codigo_unico')
            ->with('especie')
            ->join('especies', 'especies.id', '=', 'arvores.especie_id')
            ->orderByRaw('especies.nome_popular COLLATE "pt_BR"')
            ->get();

        return view('arvores.index-admin', compact('arvores'));
    }

    public function create()
    {
        \UspTheme::activeUrl('create');
        $especies = Especie::orderBy('nome_popular', 'asc')->get();
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

        $arvore = new Arvore();
        $arvore->codigo_unico = $request->codigo_unico;
        $arvore->especie_id = $request->especie;
        $arvore->porte = $request->porte;
        $arvore->latitude = $request->latitude;
        $arvore->longitude = $request->longitude;
        $arvore->save();

        $foto = new Foto();
        $foto->arvore_id = $arvore->id;
        $foto->original_name = $request->file('foto')->getClientOriginalName();
        $foto->path = $request->file('foto')->store('./fotos');
        $foto->save();

        /* fazer resie (fit) da foto e salvar na pasta public */
        $file = explode('/', $foto->path);
        $file = $file[2];
        $img_resize = \Image::make(storage_path("app/fotos/{$file}"));
        $img_resize->fit(200);
        $img_resize->save(public_path("img/{$foto->id}.jpg"));

        return redirect()->route('arvores.show', ['arvore' => $arvore->codigo_unico])->with(['success' => 'Árvore cadastrada com sucesso!']);
    }

    public function show(string $codigo)
    {
        $arvore = Arvore::where('codigo_unico', $codigo)->get()->first();
        $ocorrencias = Ocorrencia::where('arvore_id', $arvore->id)->orderBy('data_hora', 'asc')->orderBy('id', 'asc')->get();
        $comentarios = Comentario::where('arvore_id', $arvore->id)->where('moderado', true)->where('publicar', true)->orderBy('created_at', 'asc')->orderBy('id', 'asc')->get();
        $comentarios_nao_moderados = Comentario::where('arvore_id', $arvore->id)->where('moderado', false)->orderBy('created_at', 'asc')->get();
        $links = \Share::page(
            route('arvores.show', ['arvore' => $arvore->codigo_unico]),
            "Veja essa {$arvore->especie->nome_popular} na fea-RP @fearpusp",
            ['title' => 'Compartilhe']
        )->facebook()
            ->twitter()
            ->linkedin();
        return view('arvores.show', compact('arvore', 'ocorrencias', 'comentarios', 'comentarios_nao_moderados', 'links'));
    }

    public function edit(Arvore $arvore)
    {
        $especies = Especie::orderBy('nome_popular', 'asc')->get();
        return view('arvores.edit', compact('arvore', 'especies'));
    }

    public function update(Request $request, Arvore $arvore)
    {
        $messages = [
            'required' => 'O campo :attribute deve estar preenchido.',
        ];

        // Componente responsável pela validação
        $validator = Validator::make($request->all(), [
            'especie' => 'required',
            'porte' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'foto' => 'file|image|mimes:jpeg,png,jpg|max:6048',
        ], $messages);

        // Validação
        if ($validator->fails()) {
            return redirect()
                ->route('arvores.edit', ['arvore' => $arvore])->withErrors($validator)->withInput();
        }

        $arvore->especie_id = $request->especie;
        $arvore->porte = $request->porte;
        $arvore->latitude = $request->latitude;
        $arvore->longitude = $request->longitude;
        $arvore->save();

        // Caso já tenha foto cadastrada e seja enviada nova, apaga a anterior
        if (($request->foto_anterior_id) && ($request->file('foto'))) {
            $foto_anterior = Foto::find($request->foto_anterior_id);
            Storage::delete($foto_anterior->path);
            $foto_anterior->delete();
        }

        // upload da nova foto
        if ($request->file('foto')) {
            $foto = new Foto();
            $foto->arvore_id = $arvore->id;
            $foto->original_name = $request->file('foto')->getClientOriginalName();
            $foto->path = $request->file('foto')->store('./fotos');
            $foto->save();

            /* fazer resie (fit) da foto e salvar na pasta public */
            $file = explode('/', $foto->path);
            $file = $file[2];
            $img_resize = \Image::make(storage_path("app/fotos/{$file}"));
            $img_resize->fit(200);
            $img_resize->save(public_path("img/{$foto->id}.jpg"));
        }

        return redirect()->route('arvores.show', ['arvore' => $arvore->codigo_unico])->with(['success' => 'Árvore atualizada com sucesso!']);
    }

    public function destroy(Arvore $arvore)
    {
        foreach ($arvore->ocorrencias as $ocorrencia) {
            if (count($ocorrencia->arquivos) > 0) {
                $arq = Arquivo::find($ocorrencia->arquivos->first()->id);
                Storage::delete($arq->path);
                $arq->delete();
            }
        }
        $arvore->ocorrencias()->delete();
        if (count($arvore->fotos) > 0) {
            $foto_anterior = Foto::find($arvore->fotos->first()->id);
            Storage::delete($foto_anterior->path);
        }
        $arvore->fotos()->delete();
        $arvore->delete();

        return back()->with(['success' => 'Árvores excluída com sucesso!']);
    }

    public function concurso(Request $request)
    {
        \UspTheme::activeUrl('concurso');

        $search = $request->input('q');
        if ($search) {
            $arvores = Arvore::query()->select('arvores.id', 'especie_id', 'latitude', 'longitude', 'porte', 'codigo_unico')
                ->with('especie')
                ->join('especies', 'especies.id', '=', 'arvores.especie_id')
                ->where('flag_concurso', true)
                ->where('especies.nome_popular', 'ilike', "%{$search}%")
                ->orWhere('especies.nome_cientifico', 'ilike', "%{$search}%")
                ->paginate(50);

            $arvores->append(['q' => $search]);
        } else {
            $arvores = Arvore::query()->select('arvores.id', 'especie_id', 'latitude', 'longitude', 'porte', 'codigo_unico')
                ->with('especie')
                ->join('especies', 'especies.id', '=', 'arvores.especie_id')
                ->where('flag_concurso', true)
                ->paginate(50);
        }

        return view('arvores.concurso', compact('arvores'));
    }

    public function gerarCsvCompleto()
    {
        $arvores = Arvore::select(DB::raw(" concat(especies.nome_popular, ' (', especies.nome_cientifico , ')', ' cod. ', arvores.codigo_unico) as Nome, latitude, longitude"))
            ->with('especie')
            ->join('especies', 'especies.id', '=', 'arvores.especie_id')
            ->get();

        $arquivo = "arvores_" . date('Y-m-d') . ".csv";
        $separador = ",";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$arquivo",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $colunas = array('Nome', 'Latitude', 'Longitude');
        $callback = function () use ($arvores, $colunas, $separador) {
            // Create a file pointer
            $f = fopen('php://memory', 'w');
            fputcsv($f, $colunas, $separador);

            foreach ($arvores as $arvore) {
                $linha = array($arvore->nome, $arvore->latitude, $arvore->longitude);
                fputcsv($f, $linha, $separador);
            }

            // Move back to beginning of file
            fseek($f, 0);

            //output all remaining data on a file pointer
            fpassthru($f);
            fclose($f);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function gerarCsvConcurso()
    {
        $arvores = Arvore::select(DB::raw(" concat(especies.nome_popular, ' (', especies.nome_cientifico , ')', ' cod. ', arvores.codigo_unico) as Nome, latitude, longitude"))
            ->with('especie')
            ->join('especies', 'especies.id', '=', 'arvores.especie_id')
            ->where('flag_concurso', true)
            ->get();

        $arquivo = "arvores_concurso_" . date('Y-m-d') . ".csv";
        $separador = ",";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$arquivo",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $colunas = array('Nome', 'Latitude', 'Longitude');
        $callback = function () use ($arvores, $colunas, $separador) {
            // Create a file pointer
            $f = fopen('php://memory', 'w');
            fputcsv($f, $colunas, $separador);

            foreach ($arvores as $arvore) {
                $linha = array($arvore->nome, $arvore->latitude, $arvore->longitude);
                fputcsv($f, $linha, $separador);
            }

            // Move back to beginning of file
            fseek($f, 0);

            //output all remaining data on a file pointer
            fpassthru($f);
            fclose($f);
        };

        return response()->stream($callback, 200, $headers);
    }
}
