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
}
