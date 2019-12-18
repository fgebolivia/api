<?php

namespace App\Models\Denuncia;

//use App\Http\Resources\CasoResource;
//use App\Models\Denuncia\HechoPersona;
use Illuminate\Database\Eloquent\Model;

class Hecho extends Model
{
        protected $table = 'pol_hecho';

    protected $fillable = [
        'tipo_denuncia_id',          //ok
        'municipio_id',             //ok
        'user_id',                  //ok auth
        'oficina_id',               //oficina de la persona
        'estado',
        'codigo',
        'relato',                   //ok verbal
        'conducta',
        'resultado',
        'circunstancia',
        'direccion',                 //ok
        'zona',                     //ok
        'detallelocacion',          //direccion gmap
        //'investigador',
        'fechahorainicio',          //ok cuando es nulo es aproximado
        'fechahorafin',            //ok cuando es nulo no se toma en cuenta
        'aproximado',               //ok es texto explica el fechahora
        'latitude',
        'longitude',
    ];

    //public $resource = CasoResource::class;

    protected $guarded = [];

    /***relaciones**///
    /*public function user()
    {//verificar si se necesita usuario
      return $this->belongsTo('App\User','user_id');
    }*/

    public function municipio()
    {
      return $this->belongsTo('App\Models\UbicacionGeografica\UbgeMunicipio','municipio_id');
    }
    public function denuncia()
    {
      return $this->belongsTo('App\Models\Denuncia\TipoDenuncia','tipo_denuncia_id');
    }

    public function archivos()
    {
      return $this->hasMany('App\Models\Denuncia\HechoArchivo')->where('pol_archivo.estado', '=', 1);
    }

    public function personas()
    {
        return $this->belongsToMany('App\Models\Rrhh\RrhhPersona', 'pol_hechopersona',  'hecho_id', 'persona_id');
    }

    public function juridica()
    {
        return $this->belongsToMany('App\Models\Rrhh\RrhhPersonaJuridica', 'pol_hechopersona',  'hecho_id', 'persona_juridica_id' );
    }

    public function personaDesconocida()
    {
        return $this->belongsToMany('App\Models\Rrhh\RrhhPersonaDesconocida', 'pol_hechopersona',  'hecho_id', 'persona_desconocida_id' );
    }

    public function hechoPersonas()
    {
        return $this->hasMany('App\Models\Denuncia\HechoPersona',  'hecho_id' );
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot','id','estado', 'updated_at','user_id'
    ];

}
