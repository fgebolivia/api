<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class Tiempo extends Model
{
    protected $table = 'pol_tiempo';

    protected $fillable = [
        'fechahora',
        'fechahorainicio',
        'fechahorafin',
        'aproximado'
    ];

    protected $guarded = [];
}
