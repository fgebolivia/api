<?php

namespace App\Http\Controllers\metis;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertificacionPersonaComplementoResource;
use App\Http\Resources\CertificacionPersonaResource;
use App\Libraries\SegipClass;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

class ConsultaSegipcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $datos = $request->validate([
            'nombre'           => 'required|string',
            'fecha_nacimiento' => 'required|date',
            ]);
        $persona = RrhhPersona::where('n_documento',$id)->get();

        if ($persona->isEmpty())
        {

            $personacomple = RrhhPersona::where('n_documento',$id.'-'.$request->complemento)->get();

            if ($personacomple->isEmpty())
            {
                if ($request->primer_apellido == '' && $request->segundo_apellido == '')
                {
                    return $this->errorResponse('El primer o segundo apellido es obligatorio',400);
                };
                $data = [
                    'n_documento'  => $id,
                    'complemento'  => $request->complemento,
                    'nombre'       => $request->nombre,
                    'ap_paterno'   => $request->primer_apellido,
                    'ap_materno'   => $request->segundo_apellido,
                    'f_nacimiento' => $request->fecha_nacimiento
                ];
                $segip1 = new SegipClass();
                $respuesta1 = $segip1->getCertificacionSegip($data);
                if ($respuesta1['sw'] == 1)
                {
                    if ($respuesta1['respuesta']['EsValido'] == true && $respuesta1['respuesta']['CodigoRespuesta'] == '2')
                    {
                        $file_name = uniqid('certificacion_segip_', true) . ".pdf";
                        $file      = public_path('/storage/segip') . "/" . $file_name;
                        file_put_contents($file, $respuesta1['respuesta']['ReporteCertificacion']);

                        $persona = new RrhhPersona();

                            if ($request->complemento!='')
                            {
                                $n_docComplemento = $id.'-'.$request->complemento;
                            }
                            else
                            {
                                $n_docComplemento = $id;
                            }

                        $persona->n_documento              = $n_docComplemento;
                        $persona->nombre                   = $request->nombre;
                        $persona->ap_paterno               = $request->primer_apellido;
                        $persona->ap_materno               = $request->segundo_apellido;
                        $persona->f_nacimiento             = $request->fecha_nacimiento;
                        $persona->estado_segip             = 2;
                        $persona->nombre_completo          = $request->nombre.' '.trim($request->primer_apellido.' '.$request->segundo_apellido);
                        $persona->certificacion_segip      = base64_encode($respuesta1['respuesta']['ReporteCertificacion']);
                        $persona->certificacion_file_segip = $file_name;

                        $persona->save();

                        $fiscal_id =$persona->n_documento;

                        $per = RrhhPersona::where('n_documento',$n_docComplemento)->get();
                        $perosonaTransform = CertificacionPersonaResource::collection($per);
                    }
                    else
                    {
                        return $this->errorResponse('no se logro validar a la persona verifique los datos',400);
                    }
                }
                else
                {
                    return $this->errorResponse('no se logro validar a la persona 2',400);
                }
            }
            else
            {
                $perosonaTransform = CertificacionPersonaComplementoResource::collection($personacomple);
            }

        }
        else
        {
            $persona = RrhhPersona::where('n_documento',$id)->get();
            $perosonaTransform = CertificacionPersonaResource::collection($persona);

        };
        return $perosonaTransform;
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

}
