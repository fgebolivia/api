<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Model;

class RrhhPersonaDesconocida extends Model
{
     protected $table = 'rrhh_persona_desconocida';

    protected $fillable = [
        'pais_id',
        'estado',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'descripcion',
        'ap_esposo',
        'sexo',
        'f_nacimiento',
        'estado_civil',
        'domicilio',
        'telefono',
        'celular',
        'profesion_ocupacion',
        'pueblo_originario',
        'lugar_trabajo',
        'domicilio_laboral',
        'telf_laboral',
        'alias',
        'estatura',
        'tez',
        'vestimenta',
        'peso',
        'cabello',
        'ojos',
        'nombre_completo',
        'idioma_id',
        'map_latitud',
        'map_longitud',
        'tipo_documento_id',
        'municipio_id_nacimiento',
        'municipio_id_residencia',
        'n_documento',
        'email',
        'senia',
    ];

    protected $guarded  = [];

    protected $hidden = ['updated_at','id','estado']; 
}
