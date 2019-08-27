<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class HechoArchivo extends Model
{
    protected $table = 'pol_archivo';
    protected $fillable = [
        'archivo',         
        'hecho_id',        
    ];
    protected $guarded = [];
    /***relaciones**///
    public function hecho()
    {
      return $this->belongsTo('App\Models\Denuncia\Hecho','hecho_id');
    }
    /********Agregados*****/
    protected $appends = array( 
        'urlarchivo', //para select2
    );
    public function getUrlarchivoAttribute(){ //si esta registrado geolocalizacion
            return '/appfiles/documentos/'.$this->archivo;
    }
}
