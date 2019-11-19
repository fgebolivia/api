<?php

namespace App\Http\Controllers\Notificaciones;

use App\Helpers\HelperActividad;
//use App\Helpers\HelperActividadOrgano;
use App\Helpers\HelperInicioOrganoJudicial;
use App\Helpers\HelperRejaf;
use App\Http\Controllers\Controller;
use App\Libraries\SegipClass;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Notificacion\Actividad;
use App\Models\Notificacion\Caso;
use App\Models\Notificacion\TipoActividad;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

/**
* @group Metodo para Notificaciones.
*
*/

class NotificacionesController extends Controller
{
    /**
     * Metodo POST de Notificaciones
     *
     *  Este metodo se podran recibir varias notificaciones de las diferentes instituciones
    *  <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     * @bodyParam codigo_FUD string required codigo unico de la denuncia
       @bodyParam codigo_tipo_notificacion string required Código del tipo de actividad / actuado realizado hacia la Fiscalia
       @bodyParam fecha_hora_notificacion date required Fecha en la que se realiza la Actividad/Actuado
       @bodyParam sujeto array[] required Datos para la verificacionde una persona nombre apellidos fecha nacimiento
       @bodyParam notificador array[] required Datos para la verificacionde una persona nombre apellidos fecha nacimiento
       @bodyParam solicitante array[] required Datos para la verificacionde una persona nombre apellidos fecha nacimiento
       @bodyParam actuado_actividad string required descripcion del actuado o Actividad
       @bodyParam archivo BASE64 required archivo del actuado a activdad en formato PDF convertido en BASE64 maximo 10MB
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @response
     *  {
     *  "message" : "La Notificaion se Inserto satisfactoriamente",
     *  "code" : 201
     *  }
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo_fud'            => 'required|min:14|max:30|string',
            'codigo_tipo_actividad' => 'required|integer',
            'fecha_hora_actividad'  => 'required|date',
            'descripcion_actividad' => 'required|max:120|string',
            'nombre_archivo'        => 'required|max:255|string',
            'extension'             => 'required|max:255|string',
            'archivo'               => 'required',
            ]);
        // === CONSULTA CASO ===
            $caso = Caso::where('Caso',$request->codigo_fud)->select('id')->first();
            if (!$caso)
            {
                return $this->errorResponse('el codigo_fud no existe en el sistema', 400);
            }

        //=== CONSULTA TIPO ACTIVIDAD ===
            $tipoActivi = TipoActividad::where('idinter',$request->codigo_tipo_actividad)->first();
            if (!$tipoActivi)
            {
                return $this->errorResponse('El codigo de actividad no existe no existe en el sistema', 400);
            }

            $file_name = uniqid('actividad_juez_', true) .'.'.$request->extension;
            $file      = public_path('/storage/actividad') . "/" . $file_name;
            file_put_contents($file,base64_decode($request->archivo));

       // ==== ASDGBDIJF

            $valor = [
                'caso_id'           => $caso->id,
                'tipo_actividad_id' => $tipoActivi->id,
                'actividad'         => $request->descripcion_actividad,
                'documento_nombre'  => $request->nombre_archivo,
                'nombre_archivo'    => $file_name,
                'extension'         => $request->extension,
                'fh_actual'         => $request->fecha_hora_actividad,
                'documento'         => $request->archivo,
            ];


           $id = HelperActividad::createActividad($valor);

        return $this->successConection('se inserto satisfactoriamente '.$id, 201);

    }
}
