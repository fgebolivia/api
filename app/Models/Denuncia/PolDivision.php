<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class PolDivision extends Model
{
    protected $table = 'pol_division';

    protected $fillable = [
        'estado',
        'nombre',
    ];

    protected $guarded = [];
}
