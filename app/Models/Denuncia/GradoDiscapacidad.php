<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class GradoDiscapacidad extends Model
{
    protected $table = 'pol_grado_discapacidad';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
