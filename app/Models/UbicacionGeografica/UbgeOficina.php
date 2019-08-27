<?php

namespace App\Models\UbicacionGeografica;

use Illuminate\Database\Eloquent\Model;

class UbgeOficina extends Model
{
    protected $table    = 'pol_oficina';
    protected $fillable = [
        'municipio_id',
        'institucion_id',
        'estado', 
        'codigo',
        'nombre',
        'latitude',
        'longitude',
    ];
    protected $guarded  = [];

    /***relaciones**///
    public function municipio()
    {
      return $this->belongsTo('App\Models\UbicacionGeografica\UbgeMunicipio','municipio_id');
    }
    public function personas()
    {
        return $this->belongsToMany('App\Models\Rrhh\RrhhPersona', 'persona_oficina',  'oficina_id', 'persona_id' )
                    ->withTimestamps()
                    ->orderBy('created_at', 'desc')
                    //->groupby('persona_id')
                    //->distinct()    //por que los fraces relacionados se duplicaba  
                    ->withPivot('estado');
    } 

    public function institucion()
    {
        return $this->belongsTo('App\Models\Catalogos\PolInstitucion','institucion_id');
    }

    /********Agregados*****/
    protected $appends = array( 
        'georegistrado',
    );
    public function getGeoregistradoAttribute(){ //si esta registrado geolocalizacion
        if($this->longitude && $this->latitude ){
            return true;
        }else{
            return false;
        }
    }
}
