<?php

namespace App\Models\Rrhh;

//use App\Http\Resources\CasoJuridicaResource;
use Illuminate\Database\Eloquent\Model;

class RrhhPersonaJuridica extends Model
{
    protected $table = 'rrhh_persona_juridica';

    protected $fillable = [
        'municipio_id',
        'estado',
        'razon_social',
        'nit',
        'domicilio',
        'telefono',
        'map_latitud',
        'map_longitud'
    ];

    protected $guarded  = [];

    //public $resource = CasoJuridicaResource::class;

    protected $hidden = ['updated_at','id','estado'];
}
