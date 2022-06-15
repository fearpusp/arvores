<?php

namespace App\Http\Controllers;

use App\Mail\ComentarioEnviado;
use App\Models\Comentario;
use Illuminate\Support\Facades\Mail;

class ComentarioEnviadoController extends Controller
{

    public function store(Comentario $comentario)
    {
        Mail::to('lucas@fearp.usp.br')->send(new ComentarioEnviado($comentario));
    }
}
