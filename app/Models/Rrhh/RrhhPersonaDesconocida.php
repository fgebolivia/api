<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Model;

class RrhhPersonaDesconocida extends Model
{
     protected $table = 'rrhh_persona_desconocida';

    protected $fillable = [
        'pais_id',
        'estado',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'descripcion',
    ];

    protected $guarded  = [];
}
