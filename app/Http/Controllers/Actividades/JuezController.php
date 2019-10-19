<?php

namespace App\Http\Controllers\Actividades;

use App\Http\Controllers\Controller;
use App\Libraries\SegipClass;
use App\Models\Agenda\Agenda;
use App\Models\Agenda\AgendaPersona;
use App\Models\Agenda\Juzgado;
use App\Models\Denuncia\Hecho;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

/**
* @group Metodos de reparto de Juez Juzgado de un Caso.
*
*/

class JuezController extends Controller
{
    
    /**
     * Metodo POST registro del reparto de un Juez y Jusgado de un caso.
     *
     *  en este metodo podemos insertar todo los campos referentes al Juez y el reparto<br><br>
     *  <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     * @bodyParam codigo_fud string required el para la validacion 
       @bodyParam n_documento string required el carnet de identidad para validacion
       @bodyParam complemento string opcional el para la validacion
       @bodyParam nombre string required el nombre para la validacion
       @bodyParam ap_paterno string required el apellido paterno para la validacion
       @bodyParam ap_materno string required el apellido materno para la validacion
       @bodyParam fecha_nacimiento date required la fecha de nacimiento para la validacion
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @response
     *  {
     *  "message" : "El Juez se Inserto satisfactoriamente",
     *  "code" : 201
     *  }
     */
    public function store(Request $request, $codigo)
    {
        $datos = $request->validate([
        	//'codigo_juzgado' => 'required',
        	'codigo_fud' => 'required',
            'n_documento' => 'required',
            //'complemento' => 'string',
            'nombre' => 'required|string',
            'ap_paterno' => 'required|string',
            'ap_materno' => 'required|string',
            'fecha_nacimiento' => 'required|date',
        ]);

        
        $agenda = Agenda::where('codigo_audiencia',$codigo)->first();
        if ($agenda == null) {
        	return $this->errorResponse('Error el codigo del agendamiento de la audiencia no existe',400);
        }

        $caso = Hecho::where('codigo',$request->codigo_fud)->first();
        if ($caso == null) {
            return $this->errorResponse('Error el codigo del caso no existe',400);
        }

        $juzgado = Juzgado::where('codigo_juzgado',$request->codigo_juzgado)->first();
        if ($juzgado == null) {
            return $this->errorResponse('Error el codigo del Juzgado no existe',400);
        }

        $juez = RrhhPersona::where('n_documento',$request->n_documento)->first();
        if ($juez == null) {
            $segip = new SegipClass();
            $data = [
                'n_documento'  => $request->n_documento,
                'complemento'  => $request->complemento,
                'nombre'       => $request->nombre,
                'ap_paterno'   => $request->ap_paterno,
                'ap_materno'   => $request->ap_materno,
                'f_nacimiento' => $request->fecha_nacimiento
            ];

            $respuesta1 = $segip->getCertificacionSegip($data);

            if ($respuesta1['sw'] == 1) {
                if ($respuesta1['respuesta']['EsValido'] == true && $respuesta1['respuesta']['CodigoRespuesta'] == '2')
                {
                    $file_name = uniqid('certificacion_segip_', true) . ".pdf";
                    $file      = public_path('/storage/segip') . "/" . $file_name;
                    file_put_contents($file, $respuesta1['respuesta']['ReporteCertificacion']);
                    
                    $persona = new RrhhPersona();
                    $persona->n_documento          = $request->n_documento;
                    $persona->nombre               = $request->nombre;
                    $persona->ap_paterno           = $request->ap_paterno;
                    $persona->ap_materno           = $request->ap_materno;
                    $persona->f_nacimiento         = $request->fecha_nacimiento;
                    $persona->estado_segip         = 2;
                    $persona->nombre_completo          = $request->nombre.' '.trim($request->ap_paterno.' '.$request->ap_materno);
                    $persona->certificacion_segip      = base64_encode($respuesta1['respuesta']['ReporteCertificacion']);
                    $persona->certificacion_file_segip = $file_name;

                    $persona->save();
                    $juez_id =$persona->id;
                }else
                {
                    return $this->errorResponse('no se logro validar a la persona verifique los datos',400);
                }
            }else
            {
                return $this->errorResponse('no se logro validar a la persona 2',400);
            }
        	
        }else{
            $juez_id =$juez->id;
        }

        $agendajuez = new AgendaPersona();

        $agendajuez->agenda_id = $agenda->id;
        $agendajuez->persona_id = $juez_id;
        $agendajuez->tipo = 1; // 1 = juez, 2= fiscal
        $agendajuez->hecho_id = $caso->id;
        //$agendajuez->juzgado_id = $juzgado->id;
        //dd($agendajuez);
        $agendajuez->save();

        return $this->successConection('El reparto de Juez y Juzgado al CASO se incerto Correctamente',201);
    }

}
