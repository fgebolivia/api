<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class HechoEtapa extends Model
{
    protected $table = 'pol_hecho_etapa';

    protected $fillable = [
        'version',
        'nombre',
    ];

    protected $guarded = [];
}
