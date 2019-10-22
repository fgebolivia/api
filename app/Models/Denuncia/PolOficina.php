<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class PolOficina extends Model
{
    protected $table = 'pol_oficina';

    protected $fillable = [
        'municipio_id',
        'estado',
        'codigo',
        'nombre',
        'latitude',
        'longitude',
        'institucion_id',
    ];

    protected $guarded = [];
}
