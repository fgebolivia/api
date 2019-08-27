<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class TipoDenuncia extends Model
{
    protected $table = 'pol_tipo_denuncia';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
