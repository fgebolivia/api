<?php

namespace App\Http\Controllers\Actividades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
       @bodyParam tipo string opcional Descripcion de la causal de suspencion
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
                   'codigo_agendamiento' => 'required|max:250|string',
                   'codigo_tipo_causal' => 'required|max:250|string',
                   'tipo'=> 'required|max:100|string',
               ]);

        return $this->successConection('Se dio de baja el agendamiento satisfactoriamente',201);
    }
}
