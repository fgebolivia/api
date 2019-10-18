<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class ActividadTriton extends Model
{
    protected $table = 'act_actividades';

    protected $fillable = [
        'codigo_actividad',
        'tipo_actividad_id',
        'fecha_actividad',
        'descripcion_actividad',
        'nombre_archivo',
        'hecho_id',       
    ];

    protected $guarded = [];
}
