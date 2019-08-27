<?php

namespace App\Models\UbicacionGeografica;

use Illuminate\Database\Eloquent\Model;

class UbgeMunicipio extends Model
{
    protected $table    = 'ubge_municipios';
    protected $fillable = [
        'provincia_id',
        'estado',
        'codigo',
        'nombre'
    ];

    protected $guarded  = [];

    /***relaciones**///
    public function provincia()
    {
      return $this->belongsTo('App\Models\UbicacionGeografica\UbgeProvincia','provincia_id');
    }
    public function oficinas()
    {
      return $this->hasMany('App\Models\UbicacionGeografica\UbgeMunicipio');
    }   

    /********Agregados*****/
    protected $appends = array( 
        'codigounico',  
    );

    //so toma solo un caracter para municipio
    public function getCodigounicoAttribute(){ //si esta registrado geolocalizacion
         return substr($this->codigo, -1); 
    }
}
