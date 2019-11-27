<?php

namespace App\Models\Denuncia;

use App\Models\Rrhh\RrhhPersona;
use App\Models\Denuncia\PersonaMedidasProteccion;
use Illuminate\Database\Eloquent\Model;

class HechoPersona extends Model
{
    protected $table = 'pol_hechopersona';

    protected $fillable = [
        'hecho_id',
        'persona_id',
        'nombre',
        'ci',
        'estado',
        'descripcion',
        'fecha_estado_procesal',
        'persona_juridica_id',
        'persona_desconocida_id',
        'estado_libertad_id',
        'delete'
    ];

    protected $guarded = [];

     public function persona()
    {
        return $this->hasOne('App\Models\Rrhh\RrhhPersona');
    }

    public function hechos()
    {
        return $this->belongsTo('App\Models\Denuncia\Hecho', 'hecho_id');
    }

    public function medidas()
    {
        return $this->hasMany('App\Models\Denuncia\PersonaMedidasProteccion', 'hechopersona_id');
    }

    public function hechos1()
    {
        return $this->belongsToMany('App\Models\Denuncia\Hecho', 'hecho_id');
    }
}
