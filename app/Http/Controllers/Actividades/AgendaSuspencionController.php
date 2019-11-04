<?php

namespace App\Http\Controllers\Actividades;

use App\Http\Controllers\Controller;
use App\Models\Agenda\Agenda;
use App\Models\Agenda\AgendaCausal;
use App\Models\Agenda\TipoCausal;
use App\Models\Agenda\archivo;
use Illuminate\Http\Request;

/**
* @group Metodos para el Agendamiento de Audiencias.
*
*/

class AgendaSuspencionController extends Controller
{
    /**
     * Metodo POST para Informar de una la suspencionde Una Agendamiento de Audiencia
     *
     *  En este campo la oficina gestora podra dar informanos las causas de por que se dio de baja una Audiencia<br><br>
     *  <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     * @bodyParam codigo_agendamiento integer required Código único del Agendamiento
       @bodyParam codigo_tipo_causal integer required Catalogo de Causales de Suspencion
       @bodyParam descripcion string opcional Descripcion de la causal de suspencion
       @bodyParam archivo_baja_audiencia Base64 required Documento en BASE64 de la causal de baja
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     @response
     *  {
     *  "message" : "Se dio de baja el agendamiento satisfactoriamente",
     *  "code" : 201
     *  }
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
                   'codigo_agendamiento_audiencia' => 'required|integer',
                   'codigo_tipo_causal' => 'required|integer',
                   'descripcion'=> 'required|max:100|string',
                   'archivo_baja_audiencia' => 'required'
               ]);
        $agendamiento = Agenda::where('codigo_audiencia',$request->codigo_agendamiento_audiencia)->first();

        if ($agendamiento === null) {
          return $this->errorResponse('el codigo de audiencia NO EXISTE o ESTA REPETIDO',422);
        }

        $tipoCausal = TipoCausal::where('codigo_causal',$request->codigo_tipo_causal)->get()->count();

        if ($tipoCausal === 0) {
          return $this->errorResponse('el codigo del tipo de Causal NO EXISTE',422);
        }


        $agendamiento->estado = 1;
        $agendamiento->save();


        $file_name = uniqid('causal_baja_audiencia', true) . ".pdf";
        $file      = public_path('/storage/agenda/archivo_suspencion') . "/" . $file_name;
        file_put_contents($file,base64_decode($request->archivo_baja_audiencia));

        $suspencion = new AgendaCausal();

        $suspencion->agenda_id = $agendamiento->id;
        $suspencion->tipo_causal_id = $request->codigo_tipo_causal;
        $suspencion->descripcion = $request->descripcion;
        $suspencion->save();
        $id = $suspencion->id;

        $arch = new archivo();
        $arch->archivo = $file_name;
        $arch->causal_suspencion_id = $id;

        $arch->save();

        return $this->successConection('Se dio de baja el agendamiento satisfactoriamente',201);
    }
}
