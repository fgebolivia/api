<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class EstadoLibertad extends Model
{
    protected $table = 'pol_estado_libertad';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
