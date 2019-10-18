<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class HechoEstado extends Model
{
    protected $table = 'pol_hecho_estado';

    protected $fillable = [
        'version',
        'nombre',
    ];

    protected $guarded = [];
}
