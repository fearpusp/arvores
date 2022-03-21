<?php

namespace App\Http\Controllers;

use App\Models\ComentarioFoto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ComentarioFotoController extends Controller
{
    public function show(ComentarioFoto $foto)
    {
        dd($foto);
        return Storage::download($foto->path, $foto->original_name);
    }
}
