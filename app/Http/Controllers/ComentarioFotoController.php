<?php

namespace App\Http\Controllers;

use App\Models\ComentarioFoto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ComentarioFotoController extends Controller
{
    public function show(ComentarioFoto $comentario_foto)
    {
        return Storage::download($comentario_foto->path, $comentario_foto->original_name);
    }
}
