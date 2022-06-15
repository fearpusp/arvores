<?php

namespace App\Http\Controllers;

use App\Mail\ComentarioEnviado;
use App\Models\Comentario;
use Illuminate\Support\Facades\Mail;

class ComentarioEnviadoController extends Controller
{

    public function store(Comentario $comentario)
    {
        foreach (env('COMENTARIO_MODERADORES') as $destinario) {
            Mail::to($destinario)
                ->send(new ComentarioEnviado($comentario));
        }
    }
}
