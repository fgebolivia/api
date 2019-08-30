<?php

namespace App\Models\Denuncia;

use App\Models\Rrhh\RrhhPersona;
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
        'descripcion'
    ];

    protected $guarded = [];

     public function persona()
    {
        return $this->hasOne('App\Models\Rrhh\RrhhPersona');
    }

    public function hechos()
    {
        return $this->belongsTo('pp\Models\Denuncia\Hecho', 'hecho_id');
    } 
}
