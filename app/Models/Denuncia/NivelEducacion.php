<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class NivelEducacion extends Model
{
    protected $table = 'pol_nivel_educacion';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
