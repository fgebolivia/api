<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'age_agendas';

    protected $fillable = [
        'codigo_audiencia',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'sala',
        'hecho_id',
        'tipo_audiencia_id',
        'juzgado_id',
        
    ];

    protected $guarded = [];
}
