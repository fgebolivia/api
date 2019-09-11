<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class MedidaProteccion extends Model
{
    protected $table = 'pol_medida_proteccion';

    protected $fillable = [
        'estado',
        'descripcion',
        'tipo',
        'inciso'
    ];

    protected $guarded = [];
 
}
