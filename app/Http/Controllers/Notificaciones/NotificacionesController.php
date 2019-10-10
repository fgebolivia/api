<?php

namespace App\Http\Controllers\Notificaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
       @bodyParam codigo_tipo_actividad string required Código del tipo de actividad / actuado realizado hacia la Fiscalia
       @bodyParam fecha_Actividad_solicitud date required Fecha en la que se realiza la Actividad/Actuado
       @bodyParam descripcion_actividad_solicitud string required Descripción de la solicitud de Actividad/Actuado
       @bodyParam archivo_actividad_solicitud Base_64 required Archivo en PDF de la Solicitud de es tipo de Activida
       @bodyParam nombre_archivo_solicitud string required Nombre de PDF de la Solicitud de es tipo de Actividad
       @bodyParam codigo_institucion_solicitante string required Código de la Institución que solicita la Actividad
       @bodyParam codigo_sujeto_solicitante numeric required Codigo Tipo de Sujeto Procesal que Solicita la Actividad (Juez Abogado, Investigador, etc)
       @bodyParam ci_solicitante numeric required Carnet de identidad de la Persona que solicita dicha Actividad para validación
       @bodyParam complemento_solicitante string required Opcional complemento Carnet de la Persona que solicita dicha Actividad para validación
       @bodyParam nombre_solicitante string required Nombre de la Persona que solicita dicha Actividad para validación
       @bodyParam ap_paterno_solicitante string Apellido Paterno de la Persona que solicita dicha Actividad para validación
       @bodyParam ap_materno string required Apellido Materno de la Persona que solicita dicha Actividad para validación
       @bodyParam fecha_nacimiento_solicitante date required Fecha Nacimiento de la Persona que solicita dicha Actividad para validación
       @bodyParam asunto string required Descripción de qué se trata la Actividad o notificación
       @bodyParam codigo_notificacion numeric required Código en caso de que haya Dicha Notificación
       @bodyParam notificacion_electronica boolean required alguna tipo boolean (true: se realizó notificación Electrónica false: no se realizó notificación electrónica)
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
            'codigo_FUD' => 'required|max:250|string',
            'codigo_tipo_actividad' => 'required|string',
            'fecha_Actividad_solicitud' => 'required|date',
            'descripcion_actividad_solicitud' => 'required|max:550|string',
            'archivo_actividad_solicitud' => 'required|json',
            'nombre_archivo_solicitud' => 'required|string',
            'codigo_institucion_solicitante' => 'required|string',
            'codigo_sujeto_solicitante' => 'required|numeric',
            'ci_solicitante' => 'required|numeric',
            'complemento_solicitante' => 'required|string',
            'nombre_solicitante' => 'required|string',
            'ap_paterno_solicitante' => 'required|string',
            'ap_materno_solicitante' => 'required|string',
            'fecha_nacimiento_solicitante' => 'required|date',
            'asunto' => 'required|max:550|string',
            'codigo_notificacion' => 'required|numeric',
            'notificacion_electronica' => 'required|boolean',
            ]);

        //Hecho::create($datos);

        return $this->successResponse('se inserto satisfactoriamente', 201);
    }
}
