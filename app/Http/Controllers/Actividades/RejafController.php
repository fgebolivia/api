<?php

namespace App\Http\Controllers\Actividades;

use App\Http\Controllers\Controller;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

/**
* @group Metodo REJAF
*
*/

class RejafController extends Controller
{
    /**
     * Insercion con metodo POST de Certificaciones REJAF.
     *
     *  Este Metodo esta en espera de la respuesta de una solicitud anterior echa para obtener el REJAF<br><br>
     *  
     *  <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     * @bodyParam n_documento string required el carnet de identidad para validacion
       @bodyParam complemento string required el para la validacion
       @bodyParam nombre string required el nombre para la validacion
       @bodyParam ap_paterno string required el apellido paterno para la validacion
       @bodyParam ap_materno string required el apellido materno para la validacion
       @bodyParam fecha_nacimiento date required la fecha de nacimiento para la validacion
       @bodyParam solicitud string required codigo de la solicitud
       @bodyParam wed_id string required codigo web id del certificado REJAF
       @bodyParam fecha_envio date required Fecha en la que se envio el Certificado REJAF
       @bodyParam observacion string required alguna observacion del Certificado REJAF
       @bodyParam estado string required estado del Certificado REJAF
       @bodyParam certificado BASE_64 required DOCUMENTO PDF del REJAF
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
      @response
     *  {
     *  "message" : "El rejaf se Inserto satisfactoriamente",
     *  "code" : 201
     *  }
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
                       'n_documento' => 'required|max:250|string',
                       'complemento' => 'required|max:250|string',
                       'nombre'=> 'required|max:100|string',
                       'ap_paterno' => 'required|max:100|string',
                       'ap_materno' => 'required|max:100|string',
                       'fecha_nacimiento' => 'required|date',
                       'solicitud' => 'required|string',
                       'wed_id' => 'required|string',
                       'fecha_envio' => 'required|date',
                       'observacion' => 'required|string',
                       'estado' => 'required|string',
                       'certificado' => 'required|string',
                   ]);

         $per = RrhhPersona::where('n_documento',$request->n_documento)->first();

         if ($per == null) {
            $segip = new SegipClass();
            $data = [
                'n_documento'  => $request->n_documento,
                'complemento'  => $request->complemento,
                'nombre'       => $request->nombres,
                'ap_paterno'   => $request->ap_paterno,
                'ap_materno'   => $request->ap_materno,
                'f_nacimiento' => $request->fecha_nacimiento
            ];

            $respuesta1 = $segip->getCertificacionSegip($data);

            if ($respuesta1['sw'] == 1) {
                if ($respuesta1['respuesta']['EsValido'] == true && $respuesta1['respuesta']['CodigoRespuesta'] == '2') {
                    $persona = new RrhhPersona();
                    $persona->n_documento          = $request->n_documento;
                    $persona->nombre               = $request->nombres;
                    $persona->ap_paterno           = $request->primer_apellido;
                    $persona->ap_materno           = $request->segundo_apellido;
                    $persona->f_nacimiento         = $request->fecha_nacimiento;
                    $persona->save();
                    $per_id =$persona->id;
                }else
                {
                    return $this->errorResponse('no se logro validar a la persona',400);
                }
            }else
            {
                return $this->errorResponse('no se logro validar a la persona',400);
            }
            
        }else{
            $per_id =$per->id;
        }

        $file_name = uniqid('rejaf_'.$per_id, true) . ".pdf";
        $file      = public_path('/storage/rejaf/archivo') . "/" . $file_name;
        file_put_contents($file,base64_decode($request->certificado));

        $certificacion_rejaf = new CertificacionRejaf();
        $certificacion_rejaf->person_id = $per_id;
        $certificacion_rejaf->solicitud = $request->solicitud;
        $certificacion_rejaf->wed_id = $request->wed_id;
        $certificacion_rejaf->fecha_envio = $request->fecha_envio;
        $certificacion_rejaf->observacion = $request->observacion;
        $certificacion_rejaf->estado = $request->estado;
        $certificacion_rejaf->certificado = $file_name;

        $certificacion_rejaf->save();


        return $this->successConection('El rejaf se Inserto satisfactoriamente',201);
    }

}
