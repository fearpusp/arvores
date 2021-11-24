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
}
