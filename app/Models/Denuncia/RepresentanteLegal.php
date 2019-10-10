<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class RepresentanteLegal extends Model
{
    protected $table = 'representante_legal';

    protected $fillable = [
        'persona_id',
        'persona_juridica_id',
        'fecha_alta',
        'fecha_baja',
    ];

    protected $guarded = [];
}
