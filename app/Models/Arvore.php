<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arvore extends Model
{
    use HasFactory;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    //protected $dates = ['deleted_at'];
    protected $table = 'arvores';

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class);
    }

    public function especie()
    {
        return $this->belongsTo(Especie::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function comentarios_nao_moderados()
    {
        return $this->hasMany(Comentario::class)->where('moderado', false);
    }

    public function comentarios_moderados()
    {
        return $this->hasMany(Comentario::class)->where('moderado', true)->orderBy('id', 'desc');
    }

    public function comentarios_concurso()
    {
        return $this->hasMany(Comentario::class)
            ->where('moderado', true)
            ->where('publicar', true)
            ->where(function ($query) {
                $query->where('comentario', 'like', 'Concurso%')
                    ->orWhere('comentario', 'like', '%concurso%');
            });
    }
}
