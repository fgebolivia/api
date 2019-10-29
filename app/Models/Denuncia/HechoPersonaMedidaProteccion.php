<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class HechoPersonaMedidaProteccion extends Model
{
    protected $table = 'hechopersona_medidasproteccion';

    protected $fillable = [
        'estado',
        'hechopersona_id',
        'medidaproteccion_id',
        'estado_medida'
    ];

    protected $guarded = [];

}
