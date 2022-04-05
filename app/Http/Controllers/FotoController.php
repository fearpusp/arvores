<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function show(Foto $foto)
    {
        return Storage::download($foto->path, $foto->original_name);
    }

    /**
     * Recupera todas as fotos e redimensiona
     * salvando na pasta pública, com id.jpg
     */
    public function resize()
    {
        $fotos = Foto::select('*')->orderBy('id')->get();
        foreach ($fotos as $foto) {
            $file = explode('/', $foto->path);
            $file = $file[2];
            $img_resize = \Image::make(storage_path("app/fotos/{$file}"));
            $img_resize->fit(200);
            $img_resize->save(public_path("img/{$foto->id}.jpg"));
        }

        return redirect()->route('arvores.index');
    }
}
