<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class Juzgado extends Model
{
	protected $table = 'age_juzgados';

    protected $fillable = [
        'codigo_juzgado',
        'nombre',
        'municipio_id',
        'oficina_gestora',
        'zona',
        'telefono',
        'edificio',
        'direccion',
        'map_latitud',
        'map_longitud'
    ];

    protected $guarded = [];
}
