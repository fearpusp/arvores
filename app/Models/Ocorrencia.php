<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    use HasFactory;

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class);
    }

    public function arvore()
    {
        return $this->belongsTo(Arvore::class);
    }
}
