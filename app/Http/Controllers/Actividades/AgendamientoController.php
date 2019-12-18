<?php

namespace App\Http\Controllers\Actividades;

use App\Helpers\HelperJuzgado;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendasCasoResource;
use App\Http\Resources\AgendasResource;
use App\Models\Agenda\Agenda;
use App\Models\Agenda\AgendaPersona;
use App\Models\Agenda\Juzgado;
use App\Models\Agenda\TipoAudiencia;
use App\Models\Agenda\TipoCausal;
use App\Models\Agenda\archivo;
use App\Models\Denuncia\Hecho;
use App\Models\Rrhh\RrhhPersona;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\User;
use Illuminate\Http\Request;

/**
* @group Metodos para el Agendamiento de Audiencias.
*
*/

class AgendamientoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha_del = isset($_GET['fecha_del'])?$_GET['fecha_del']: 5;
        $fecha_al  = isset($_GET['fecha_al'])?$_GET['fecha_al']: 5;
        $userId    = isset($_GET['persona_id'])?$_GET['persona_id']: 5;

        $usuario = User::Where('id',$userId)->where('i4_funcionario_id','!=',null)->select('id','name','email','persona_id')->first();
        $personaAgenda = RrhhPersona::where('id',$usuario->persona_id)->first();
        $agendasPersonas = AgendaPersona::where('persona_id',$usuario->persona_id)->where('eforo',1)->get();

        $casoAgenTranform =  array();

        foreach ($agendasPersonas as $key) {
            $agenda = AgendasResource::tranformarAgenda($key, $fecha_del, $fecha_al);
            if ($agenda) {
                $casoAgenTranform[] = $agenda;
            }
        }

        return $casoAgenTranform;
    }
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
            'codigo_fud'            => 'required',
            'codigo_agendamiento'   => 'required|integer',
            'fecha_hora_inicio'     => 'required|date',
            'fecha_hora_fin'        => 'required|date',
            'codigo_tipo_audiencia' => 'required|integer',
            'sala'                  => 'required|string',
            'codigo_juzgado'        => 'required|integer',
            'archivo_pdf'           => 'required|string',
        ]);
        $count = Agenda::where('codigo_audiencia',$request->codigo_agendamiento)->get()->count();

        if ($count >=1) {
            return $this->errorResponse('Error el codigo de audiencia ya existe',422);
        }

        $hecho = Hecho::where('codigo',$request->codigo_fud)->first();
        $audienciaTipo = TipoAudiencia::where('id',$request->codigo_tipo_audiencia)->first();
        //dd($audienciaTipo);



        $juzgado = Juzgado::where('codigo_juzgado',$request->codigo_juzgado)->first();
        if ($juzgado === null) {

            $juzgado1 = new HelperJuzgado();
            $respuesta = $juzgado1->GetJuzgado($request->codigo_juzgado);
            $juzgado_id = $respuesta;

        }else
        {
            $juzgado_id = $juzgado->id;
        }
        $j=0;
        foreach ($request->input('fiscales') as $key => $value)
        {
            $existeFiscal = RrhhPersona::where('n_documento',$request->input('fiscales.'.$j.'.ci_fiscal'))->first();
            if (!$existeFiscal) {
                return $this->errorResponse('el fiscal no Existe',400);
            }
            $j++;
        }

        $agenda = new Agenda();

        //convertir el base64 en un pdf y guardarlo en una carpeta
        $file_name = uniqid('gendamiento_audiencia', true) . ".pdf";
        $file      = public_path('/storage/agenda/archivo') . "/" . $file_name;
        file_put_contents($file,base64_decode($request->archivo_pdf));

        $agenda->codigo_audiencia  = $request->codigo_agendamiento;
        $agenda->codigo_unico      = $request->codigo_fud;
        $agenda->fecha_hora_inicio = $request->fecha_hora_inicio;
        $agenda->fecha_hora_fin    = $request->fecha_hora_fin;
        $agenda->sala              = $request->sala;
        $agenda->hecho_id          = $hecho->id;
        $agenda->tipo_audiencia_id = $audienciaTipo->id;
        $agenda->juzgado_id        = $juzgado_id;
        $agenda->estado            = 0;

        $agenda->save();

        $id = $agenda->id;

        $i=0;
        foreach ($request->input('fiscales') as $key => $value)
        {
            $existeFiscal = RrhhPersona::where('n_documento',$request->input('fiscales.'.$i.'.ci_fiscal'))->first();
            if (!$existeFiscal) {
                return $this->errorResponse('el fiscal no Existe',400);
            }

            $insertFiscal             = new AgendaPersona();
            $insertFiscal->agenda_id  = $id;
            $insertFiscal->persona_id = $existeFiscal->id;
            $insertFiscal->tipo       = 2;
            $insertFiscal->hecho_id   = $hecho->id;
            $insertFiscal->juzgado_id = $juzgado_id;
            $insertFiscal->save();
            $i++;
        }


        $arch = new archivo();
        $arch->archivo = $file_name;
        $arch->agendamiento_id = $id;

        $arch->save();
        $idarch = $arch->id;

        return $this->successConection('se inserto correctamente codigo interno '.$id.' codigo archivo '.$idarch,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($PersonaId)
    {
        return AgendasCasoResource::tranformarAgenda($PersonaId);
    }
}
