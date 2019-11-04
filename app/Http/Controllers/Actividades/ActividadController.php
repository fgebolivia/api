<?php

namespace App\Http\Controllers\Actividades;

use App\Helpers\AbogadosOrganoHelper;
use App\Helpers\HelperInicioOrganoJudicial;
use App\Helpers\HelperRejaf;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActividadResource;
use App\Models\Agenda\ActividadTriton;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoFelony;
use App\Models\Notificacion\Caso;
use App\Models\Notificacion\TipoActividad;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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



         $datos = $request->validate([
            'codigo_fud' => 'required',
            'persona_ci' => 'required',
            ]);

        $hecho = Hecho::where('codigo',$request->codigo_fud)->first();
        /*
        $esto = new HelperInicioOrganoJudicial();

        //$respuesta = $esto->insertFormularioUnico($hecho->i4_caso_id);//{"codigo":"201","mensaje":"Created","idJuzgado":42}

        $respuesta2 = $esto->inserSujetosProcesales($hecho->id);

        //return $respuesta;
        return $respuesta2;
        */

        /*
        $esto = new HelperRejaf();
        $respuesta = $esto->GetRejaf($request->persona_ci,$request->codigo_fud);
        return $respuesta;
        */

        $esto = new AbogadosOrganoHelper();
        $respuesta = $esto->postAbogado($hecho->id);
        return $respuesta;

        /*
        $esto = new HelperActividadOrgano();
        $respuesta = $esto->PostActividad($request->codigo_fud,$request->actividad_id);
        return $respuesta;
        */
    //====  ACTIVIDADES NO BORRAR =====
        /*
        $datos = $request->validate([
            'codigo_fud' => 'required|string',
            'codigo_actividad' => 'required|integer',
            'codigo_tipo_actividad' => 'required|integer',
            'fecha_actividad' => 'required|date',
            'descripcion_actividad' => 'required|string',
            'archivo_actividad' => 'required|string',
            ]);

        $caso = Hecho::where('codigo',$request->codigo_fud)->first();

        if ($caso == null) {
            return $this->errorResponse('el codigo del caso no exite',422);
        }

        $tipoActi = TipoActividad::where('id',$request->codigo_tipo_actividad)->first();
        if ($tipoActi == null) {
            return $this->errorResponse('el codigo del tipo de Activida no exite',422);
        }

        $file_name = uniqid('actividad'.$tipoActi->TipoActividad, true) . ".pdf";
        $file      = public_path('/storage/actividad') . "/" . $file_name;
        file_put_contents($file,base64_decode($request->archivo_actividad));

        $activi = new ActividadTriton();

        $activi->codigo_actividad = $request->codigo_actividad;
        $activi->tipo_actividad_id = $tipoActi->id;
        $activi->nombre_tipo_actividad = $tipoActi->TipoActividad;
        $activi->fecha_actividad = $request->fecha_actividad;
        $activi->descripcion_actividad = $request->descripcion_actividad;
        $activi->nombre_archivo = $file_name;
        $activi->hecho_id = $caso->id;
        $activi->save();

         return $this->successConection('la Actividad se Registro con Exito',201);*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //==== INDEX NO BORRAR =====
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
            /*
            $caso = Caso::where('Caso', $id)->first();
            if ($caso == null) {
                return $this->errorResponse('Does not exists any endpoint for this URL',404);
            }else{
                //dd($caso->id);
                $hechos1 = new ActividadResource($caso);
                //dd($hechos1);
                return $hechos1;
            }*/
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
