<?php

namespace App\Models\Denuncias;

use Illuminate\Database\Eloquent\Model;

class HechoPersona extends Model
{
    protected $table = 'pol_hechopersona';

    protected $fillable = [
        'hecho_id',
        'persona_id',
        'nombre',
        'ci',
        'estado',
        'descripcion'
    ];

    protected $guarded = [];
}
