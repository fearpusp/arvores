<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arvore()
    {
        return $this->belongsTo(Arvore::class);
    }
}
