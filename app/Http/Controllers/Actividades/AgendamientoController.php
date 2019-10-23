<?php

namespace App\Http\Controllers\Actividades;

use App\Helpers\HelperJuzgado;
use App\Http\Controllers\Controller;
use App\Models\Agenda\Agenda;
use App\Models\Agenda\Juzgado;
use App\Models\Agenda\TipoAudiencia;
use App\Models\Agenda\TipoCausal;
use App\Models\Agenda\archivo;
use App\Models\Denuncia\Hecho;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use Illuminate\Http\Request;

/**
* @group Metodos para el Agendamiento de Audiencias.
*
*/

class AgendamientoController extends Controller
{
    /**
     * Metodo POST para la insercion del Agendamiento de las Audiencias.
     *
     *  en este metodo podemos insertar todo los campos referentes al sujeto procesal<br><br>
     *  <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     * @bodyParam codigo_fud string required Código Único de la Denuncia
       @bodyParam codigo_agendamiento integer required Código único del Agendamiento
       @bodyParam fecha_hora_inicio date required Fecha y hora de inicio de audiencia (aaaa-MM-dd hh:mm) (2019-10-03 17:00)
       @bodyParam fecha_hora_fin date required Fecha y hora fin de audiencia (aaaa-MM-dd hh:mm) (2019-10-03 19:00)
       @bodyParam codigo_tipo_audiencia integer Catálogo de Tipos de Audiencias
       @bodyParam sala string required Denominativo de la sala donde se llevara a cabo la Audiencia
       @bodyParam codigo_juzgado string required Juzgado id del catálogo de juzgados
       @bodyParam archivo_pdf BASE_64 required Documento tipo PDF en base 64 referente a la audiencia
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
      @response
     *  {
     *  "message" : "El Agendamiento se Inserto satisfactoriamente",
     *  "code" : 201
     *  }
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo_fud' => 'required',
            'codigo_agendamiento' => 'required|integer',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date',
            'codigo_tipo_audiencia' => 'required|integer',
            'sala' => 'required|string',
            'codigo_juzgado' => 'required|integer',
            'archivo_pdf' => 'required|string',
        ]);
        $count = Agenda::where('codigo_audiencia',$request->codigo_agendamiento)->get()->count();
        
        if ($count >1) {
            return $this->errorResponse('Error el codigo de audiencia ya existe',422);
        }
        
        $hecho = Hecho::where('codigo',$request->codigo_fud)->first();
        $audienciaTipo = TipoAudiencia::where('codigo_audiencia',$request->codigo_tipo_audiencia)->first();
        $juzgado = Juzgado::where('codigo_juzgado',$request->codigo_juzgado)->first();
        if ($juzgado === null) {

            $juzgado1 = new HelperJuzgado();
            $respuesta = $juzgado1->GetJuzgado($request->codigo_juzgado);
            $juzgado_id = $respuesta;

        }else{ $juzgado_id = $juzgado->id; }

        $agenda = new Agenda();

        //convertir el base64 en un pdf y guardarlo en una carpeta
        $file_name = uniqid('gendamiento_audiencia', true) . ".pdf";
        $file      = public_path('/storage/agenda/archivo') . "/" . $file_name;
        file_put_contents($file,base64_decode($request->archivo_pdf));

        $agenda->codigo_audiencia = $request->codigo_agendamiento;
        $agenda->codigo_unico = $request->codigo_fud;
        $agenda->fecha_hora_inicio = $request->fecha_hora_inicio;
        $agenda->fecha_hora_fin = $request->fecha_hora_fin;
        $agenda->sala = $request->sala;
        $agenda->hecho_id = $hecho->id;
        $agenda->tipo_audiencia_id = $audienciaTipo->id;
        $agenda->juzgado_id = $juzgado_id;
        $agenda->estado = 0;

        $agenda->save();

        $id = $agenda->id;

        $arch = new archivo();
        $arch->archivo = $file_name;
        $arch->agendamiento_id = $id;

        $arch->save();
        $idarch = $arch->id;

        return $this->successConection('se inserto correctamente codigo interno'.$id.' codigo archivo '.$idarch,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
