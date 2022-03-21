<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioFoto extends Model
{
    use HasFactory;
    protected $table = 'comentarios_fotos';

    public function comentario()
    {
        return $this->belongsTo(Comentario::class);
    }
}
