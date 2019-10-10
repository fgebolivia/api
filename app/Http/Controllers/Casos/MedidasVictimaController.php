<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedidaProteccionResource;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

/**
* @group Metodos Medidas de Proteccion.
*
*/

class MedidasVictimaController extends Controller
{
    /**
     * Listado GET de Medidas de Proteccion.
     *
     *  Este metodo es para obtener las Medidas de Proteccion de una Victima <br><br>
     *  en la Url se debe colocar el ci de la persona como el numero de caso <br>
     *  Url base acompañado del ?ci= numero de carnet<br>
     * @return \Illuminate\Http\Response
     * @response
     *  {
     *       "data": [
     *           {
     *               "codigo_medida_proteccion": 1,
     *               "tipo": 1,
     *               "inciso": 1,
     *               "descripcion": "Salida o desocupación del domicilio donde habita la víctima, independientemente de la titularidad del bien inmuebl"
     *           },
     *           {
     *               "codigo_medida_proteccion": 2,
     *               "tipo": 1,
     *               "inciso": 2,
     *               "descripcion": "Prohibición de ingreso al domicilio de la víctima, aunque se trate del domicilio familia"
     *           },
     *          {
     *               "codigo_medida_proteccion": 8,
     *               "tipo": 1,
     *               "inciso": 8,
     *               "descripcion": "Prohibición de acercarse, en el radio de distancia que determine la jueza o el juez, al lugar de residencia, trabajo, estudio, \r\nesparcimiento o a los lugares de habitual concurrencia de la víctima"
     *           },
     *           {
     *               "codigo_medida_proteccion": 12,
     *               "tipo": 1,
     *               "inciso": 12,
     *               "descripcion": "Fijación provisional de la asistencia familiar, cuando la persona imputada sea el progenitor"
     *           },
     *           {
     *               "codigo_medida_proteccion": 9,
     *               "tipo": 1,
     *               "inciso": 9,
     *               "descripcion": "Prohibición de transitar por los lugares de recorrido frecuente de la víctima"
     *           }
     *       ],
     *       "links": {
     *           "first": null,
     *           "last": null,
     *           "prev": null,
     *           "next": null
     *       },
     *       "meta": {
     *           "página_actual": 1,
     *           "url_primera_pagina": "http://api-dev3.fiscalia.gob.bo/api/v2/casos/35101020100600/medidas?page=1",
     *           "desde": 1,
     *           "ultima_pagina": 1,
     *           "url_ultima_pagina": "http://api-dev3.fiscalia.gob.bo/api/v2/casos/35101020100600/medidas?page=1",
     *           "url_pagina_siguiente": null,
     *           "path": "http://api-dev3.fiscalia.gob.bo/api/v2/casos/35101020100600/medidas",
     *           "por_pagina": 15,
     *           "purl_pagina_anterior": null,
     *           "a": 5,
     *           "total": 5
     *     }
     *   }
     */
    public function index($hecho) 
    {
        $ci=  isset($_GET['ci'])?$_GET['ci']: 5;
        $reserva = Hecho::where('codigo',$hecho)->first();

        //dd($reserva->reserva);
        if ($ci == 5 || $reserva->reserva === 1) {
            return $this->errorResponse('Escriba un CI valido o el caso '.$hecho.' no existe' ,200);
        }
        if ($reserva->reserva === 1) {
            return $this->errorResponse('El caso '.$hecho.' esta en reserva' ,200);
        }
        $persona_id = RrhhPersona::where('n_documento',$ci)->first();

        $hechopersona = HechoPersona::where('hecho_id', $reserva->id)->where('persona_id',$persona_id->id)->where('tipo_sujeto_id',3)->first();

        if ($hechopersona == null) {
            return $this->errorResponse('la persona con CI: '.$ci.' no tiene medidas de proteccion' ,200);
        }

        $medidas = HechoPersona::where('id',$hechopersona->id)->first()->medidas()->Paginate(15);
        
        $medidasTransFormada = MedidaProteccionResource::collection($medidas);

        return $medidasTransFormada;
    }
}
