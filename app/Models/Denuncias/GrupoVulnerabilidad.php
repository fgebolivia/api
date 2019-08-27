<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class GrupoVulnerabilidad extends Model
{
    protected $table = 'pol_grupo_vulnerable';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
