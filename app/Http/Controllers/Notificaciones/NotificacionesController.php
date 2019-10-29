<?php

namespace App\Http\Controllers\Notificaciones;

use App\Helpers\HelperActividadOrgano;
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
            'codigo_fud'               => 'required|max:250|string',
            'codigo_tipo_notificacion' => 'required|integer',
            'descripcion_notificacion' => 'required|string',
            'fecha_hora_notificacion'  => 'required|date',
            'codigo_tipo_actividad'    => 'required|integer',
            'n_documento_Juez'         => 'required|numeric',
            'complemento_Juez'         => 'string',
            'nombre_Juez'              => 'required|string',
            'ap_paterno_Juez'          => 'required|string',
            'ap_materno_Juez'          => 'required|string',
            'fecha_nacimiento_Juez'    => 'required|date',
            'nombre_archivo'           => 'required|string',
            'extencion'                => 'required|string',
            'archivo'                  => 'required',
            ]);
        // === CONSULTA CASO ===
            $caso = Caso::where('Caso',$request->codigo_fud)->select('id')->first();
            if (!$caso)
            {
                return $this->errorResponse('el codigo_fud no existe en el sistema', 400);
            }

        //=== CONSULTA TIPO ACTIVIDAD ===
            $tipoActivi = TipoActividad::where('idinter',$request->codigo_tipo_actividad)->select('id')->first();
            if (!$tipoActivi)
            {
                return $this->errorResponse('el codigo de actividad no existe no existe en el sistema', 400);
            }

        //=== CONSULTA PERSONA JUEZ ===
            $juez = RrhhPersona::where('n_documento',$request->n_documento_Juez)->first();
            if ($juez === null)
            {
                $segip = new SegipClass();
                $data = [
                    'n_documento'  => $request->n_documento,
                    'complemento'  => $request->complemento,
                    'nombre'       => $request->nombre,
                    'ap_paterno'   => $request->ap_paterno,
                    'ap_materno'   => $request->ap_materno,
                    'f_nacimiento' => $request->fecha_nacimiento
                ];

            //=== CERTIFICACION SEGIP ===
                $respuesta1 = $segip->getCertificacionSegip($data);
                if ($respuesta1['sw'] == 1)
                {
                    if ($respuesta1['respuesta']['EsValido'] == true && $respuesta1['respuesta']['CodigoRespuesta'] == '2')
                    {
                        $file_name = uniqid('certificacion_segip_', true) . ".pdf";
                        $file      = public_path('/storage/segip') . "/" . $file_name;
                        file_put_contents($file, $respuesta1['respuesta']['ReporteCertificacion']);

                        $persona = new RrhhPersona();

                        //=== INSERTAR EN TABLA PERSONA EN RRHHPERSONA ==
                        $persona->n_documento              = $request->n_documento;
                        $persona->nombre                   = $request->nombre;
                        $persona->ap_paterno               = $request->ap_paterno;
                        $persona->ap_materno               = $request->ap_materno;
                        $persona->f_nacimiento             = $request->fecha_nacimiento;
                        $persona->estado_segip             = 2;
                        $persona->nombre_completo          = $request->nombre.' '.trim($request->ap_paterno.' '.$request->ap_materno);
                        $persona->certificacion_segip      = base64_encode($respuesta1['respuesta']['ReporteCertificacion']);
                        $persona->certificacion_file_segip = $file_name;

                        $persona->save();
                        $juez_id =$persona->id;
                    }else
                    {
                        return $this->errorResponse('no se logro validar a la persona verifique los datos',400);
                    }
                }
                else
                {
                    return $this->errorResponse('no se logro validar a la persona 2',400);
                }
            }else
            {

            }


       // ==== ASDGBDIJF
            /*
            $nuevaActividad = new Actividad();

            $nuevaActividad->Fecha = $request->fecha_hora_notificacion;
            $nuevaActividad->Actividad = $request->descripcion_notificacion;
            $nuevaActividad->Documento = $request->archivo;//base 64 ponerlo en elfichero
            $nuevaActividad->_Documento = $request->nombre_archivo;//nombre del documento
            $nuevaActividad->CreatorFullName = ;
            $nuevaActividad->Caso = ;//id caso
            $nuevaActividad->TipoActividad = ; //id tipoactividad
            $nuevaActividad->EstadoDocumento = 2;
            $nuevaActividad->CalFecha = ;
            $nuevaActividad->Asigndo = ;
            $nuevaActividad->FechaIni = ;
            $nuevaActividad->FechaFin = ;
            $nuevaActividad->ActividadActualizaEstadoCaso = ;
            $nuevaActividad->estado_triton = ;
            $nuevaActividad->aprobado_cd = ,
            $nuevaActividad->estado_caso_id = ;
            $nuevaActividad->etapa_caso_id = ;
            $nuevaActividad->fh_actividad = $request->fecha_hora_notificacion;
            $nuevaActividad->nombre_archivo = ;
            $nuevaActividad->extension = ;
            $nuevaActividad->nombre = ;

        */


        return $this->successConection('se inserto satisfactoriamente', 201);

    }
}
