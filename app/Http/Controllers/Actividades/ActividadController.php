<?php

namespace App\Http\Controllers\Actividades;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActividadResource;
//use App\Http\Resources\DelitoResource;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoFelony;
use App\Models\Notificacion\Caso;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

/**
* @group Metodos Actividades.
*
*/

class ActividadController extends Controller
{
  
    /**
     * Metodo POST de Notificaciones
     *
     *  Este metodo se podran recibir varias notificaciones de las diferentes instituciones
    *  <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     * @bodyParam codigo_fud string required Codigo unido del Caso
       @bodyParam codigo_actividad integer required Código único de la Actividad
       @bodyParam codigo_tipo_actividad integer required Código del catálogo de tipo de actividad
       @bodyParam fecha_actividad date required Fecha de Emisión de la Actividad
       @bodyParam descripcion_actividad string required Pequeña descripción de la actividad
       @bodyParam archivo_actividad BASE64 required Archivo relacionado con la Actividad en formato PDF (base64)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @response
     *  {
     *  "message" : "La Actividad se Inserto satisfactoriamente",
     *  "code" : 201
     *  } 
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$hecho = Hecho::where('codigo',$id)->first();
        //return $this->ShowOne($delito,200);
        if ($hecho == null) {
            return $this->errorResponse('Does not exists any endpoint for this URL',404);
        }else{
            //dd($hecho->id);
            $hechos1 = new DelitoResource($hecho);
            //dd($hechos1);
            return $hechos1;
        }*/
        $caso = Caso::where('Caso', $id)->first();
        if ($caso == null) {
            return $this->errorResponse('Does not exists any endpoint for this URL',404);
        }else{
            //dd($caso->id);
            $hechos1 = new ActividadResource($caso);
            //dd($hechos1);
            return $hechos1;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
