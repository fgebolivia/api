<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Model;

class RrhhPersona extends Model
{
    protected $table = 'rrhh_personas';
    protected $fillable = [
        'municipio_id_nacimiento',
        'municipio_id_residencia',
        'pais_id',
        'idioma_id',
        'estado',
        'n_documento',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'ap_esposo',
        'sexo',
        'f_nacimiento',
        'estado_civil',
        'domicilio',
        'telefono',
        'celular',
        'estado_segip',
        'certificacion_segip',
        'nombre_completo'
        //'certificacion_file_segip',
        //'profesion_ocupacion',
        //'pueblo_originario',
        //'lugar_trabajo',
        //'domicilio_laboral',
        //'telf_laboral',
        //'alias',
        // 'estatura',
        // 'tez',
        // 'edad',
        // 'vestimenta',
        // 'senia',
        // 'peso',
        // 'cabello',
        // 'estado_persona',
        // 'nombre_completo',
        // 'genero',
        // 'email'

    ];
    protected $guarded  = [];

    protected $hidden = ['certificacion_segip']; 
    /***relaciones**///
    //todo sus oficinas, activos e inactivos
    public function oficinas(){
      return $this->belongsToMany('App\Models\UbicacionGeografica\UbgeOficina', 'persona_oficina', 'persona_id','oficina_id')
            ->get();
    } 

    //Obtiene oficina actual activo de la persona
    //si no tiene ninguna, retorna null
    public function oficina(){
      return $this->belongsToMany('App\Models\UbicacionGeografica\UbgeOficina', 'persona_oficina', 'persona_id','oficina_id')
                  ->wherePivot('estado', '=', 1) //cuando es pivot se refiere a la persona_oficina
                  ->first();                        
    }    

    /********Agregados*****/
    protected $appends = array( 
        'fullname',
    );
    public function getFullnameAttribute(){ //si esta registrado geolocalizacion
       return $this->nombre.' '.$this->ap_paterno.' '.$this->ap_materno;
    }
}
