<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArquivoController extends Controller
{
    public function show(Arquivo $arquivo)
    {
        return Storage::download($arquivo->path, $arquivo->original_name);
    }
}
