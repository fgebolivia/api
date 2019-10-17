<?php

namespace App\Http\Controllers\Notificaciones;

use App\Http\Controllers\Controller;
use App\Helpers\HelperInicioOrganoJudicial;
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
        /*$datos = $request->validate([
            'codigo_fud' => 'required|max:250|string',
            'codigo_tipo_notificacion' => 'required|string',
            'fecha_hora_notificacion' => 'required|date',
            'codigo_tipo_sujeto' => 'required|max:550|string',
            'actuado_actividad' => 'required|json',
            'archivo' => 'required|string',
            'codigo_institucion_solicitante' => 'required|string',
            'codigo_sujeto_solicitante' => 'required|numeric',

            'n_documento_sujeto' => 'required|numeric',
            'complemento_sujeto' => 'required|string',
            'nombre_sujeto' => 'required|string',
            'ap_paterno_sujeto' => 'required|string',
            'ap_materno_sujeto' => 'required|string',
            'fecha_nacimiento_sujeto' => 'required|date',

            'n_documento_notificador' => 'required|numeric',
            'complemento_notificado' => 'required|string',
            'nombre_notificador' => 'required|string',
            'ap_paterno_notificador' => 'required|string',
            'ap_materno_notificador' => 'required|string',
            'fecha_nacimiento_notificado' => 'required|date',

            'n_documento_solicitante' => 'required|numeric',
            'complemento_solicitante' => 'required|string',
            'nombre_solicitante' => 'required|string',
            'ap_paterno_solicitante' => 'required|string',
            'ap_materno_solicitante' => 'required|string',
            'fecha_nacimiento_solicitante' => 'required|date',
            ]);*/

        //Hecho::create($datos);
        $esto = new HelperInicioOrganoJudicial();


        $respuesta = $esto->insertFormularioUnico();
        return $respuesta;
        //return $this->successResponse('se inserto satisfactoriamente', 201);
    }
}
