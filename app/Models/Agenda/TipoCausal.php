<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class TipoCausal extends Model
{
    protected $table = 'age_tipo_causales';

    protected $fillable = [
        'codigo_causal',
        'nombre',
    ];

    protected $guarded = [];
}
