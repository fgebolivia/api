<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Model;

class RrhhPersonaJuridica extends Model
{
    protected $table = 'rrhh_persona_juridica';

    protected $fillable = [
        'municipio_id',
        'estado',
        'razon_social',
        'nit',
        'domicilio',
        'telefono',
    ];

    protected $guarded  = [];
}
