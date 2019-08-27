<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class RelacionVictima extends Model
{
    protected $table = 'pol_relacion_victima';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
