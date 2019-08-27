<?php

namespace App\Models\UbicacionGeografica;

use Illuminate\Database\Eloquent\Model;

class UbgePais extends Model
{
    protected $table    = 'ubge_pais';

    protected $fillable = [
        'estado',
        'nombre',
        'codigo_2',
        'codigo_3',
        'cod_telf'
    ];

    protected $guarded  = [];

}
