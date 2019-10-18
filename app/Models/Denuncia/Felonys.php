<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class Felonys extends Model
{
    protected $table = 'felonys';

    protected $fillable = [
        'codigo',
        'titulo',
        'capitulo',
        'numero',
        'articulo',
        'inciso',
        'clase_delito',
        'materia',
        'pena_minima',
        'pena_maxima',
        'delito',
        'libro',
    ];

    protected $guarded = [];
}
