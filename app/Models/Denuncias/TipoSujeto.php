<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class TipoSujeto extends Model
{
    protected $table = 'pol_tipo_sujeto';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
