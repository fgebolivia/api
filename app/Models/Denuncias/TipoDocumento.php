<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'pol_tipo_documento';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
