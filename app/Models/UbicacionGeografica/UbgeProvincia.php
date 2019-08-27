<?php

namespace App\Models\UbicacionGeografica;

use Illuminate\Database\Eloquent\Model;

class UbgeProvincia extends Model
{
    protected $table    = 'ubge_provincias';
    protected $fillable = [
        'departamento_id',
        'estado',
        'codigo',
        'nombre'
    ];
    protected $guarded  = [];

    /***relaciones**///
    public function departamento()
    {
      return $this->belongsTo('App\Models\UbicacionGeografica\UbgeDepartamento','departamento_id');
    }
    public function nunicipios()
    {
      return $this->hasMany('App\Models\UbicacionGeografica\UbgeMunicipio');
    }
    /********Agregados*****/
    protected $appends = array( 
        'codigounico',  
    );
    
    public function getCodigounicoAttribute(){ //si esta registrado geolocalizacion
         return substr($this->codigo, -2); 
    }    
}
