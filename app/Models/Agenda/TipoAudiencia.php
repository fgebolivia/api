<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class TipoAudiencia extends Model
{
    protected $table = 'age_tipo_audiencias';

    protected $fillable = [
        'codigo_audiencia',
        'nombre',
    ];

    protected $guarded = [];
}
