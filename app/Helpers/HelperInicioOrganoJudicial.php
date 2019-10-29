<?php

namespace App\Helpers;

use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\HistoricoEstadoLibertad;
use App\Models\Denuncia\MedidaProteccion;
use App\Models\Denuncia\PersonaMedidasProteccion;
use App\Models\Denuncia\PolDivision;
use App\Models\Denuncia\RepresentanteLegal;
use App\Models\Denuncia\Sujeto;
use App\Models\Notificacion\Actividad;
use App\Models\Notificacion\Caso;
use App\Models\Notificacion\CasoDelito;
use App\Models\Notificacion\CasoFuncionario;
use App\Models\Notificacion\Delito;
use App\Models\Notificacion\Funcionario;
use App\Models\Rrhh\RrhhPersona;
use App\Models\Rrhh\RrhhPersonaDesconocida;
use App\Models\Rrhh\RrhhPersonaJuridica;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class HelperInicioOrganoJudicial
{
   public static function insertFormularioUnico($casoId)
    {
        // === INICIALIZACION DE VARIABLES ===
            $respuesta = array(
                'sw'            => false,
                'mensaje'       => '',
                'api_respuesta' => ''
            );

        // === CONSULTAS ===
            // === HECHO TRITON ===
                $hecho = Hecho::where('i4_caso_id',$casoId)->first();
                if ($hecho === null)
                {
                    $respuesta['mensaje'] = 'El hecho no exite.';
                    \Log::warning('CONSULTA HECHO TRITON: El hecho no exite.');
                    return $respuesta;
                }

            // === HECHO I4 ===
                $casoi4 = Caso::find($casoId);
                if ($casoi4 === null)
                {
                    $respuesta['mensaje'] = 'No exite hecho en el i4, debe de sincronizar.';
                    \Log::warning('CONSULTA CASO I4: El caso no exite.');
                    return $respuesta;
                }

            // === ARRAY DE ACTIVIDADES ===
                $arrayActividades = Actividad::where('Caso',$casoi4->id)->get();
                if ($arrayActividades->isEmpty())
                {
                    $respuesta['mensaje'] = 'No exite actividades.';
                    \Log::warning('CONSULTA ACTIVIDADES I4: No exite actividades.');
                    return $respuesta;
                }

            // === ARRAY DELITOS ===
                $arrayDelitos =CasoDelito::leftJoin("Delito AS del", "del.id", "=", "CasoDelito.Delito")
                                    ->select(
                                        'CasoDelito.id AS caso_delito_id',
                                        'CasoDelito.Tentativa AS tentativa',
                                        'del.id AS delito_id',
                                        'del.Delito AS delito_nombre',
                                        'del.codigo AS delito_codigo'
                                    )
                                    ->where('CasoDelito.Caso', $casoi4->id)
                                    ->get();
                if ($arrayDelitos->isEmpty())
                {
                    $respuesta['mensaje'] = 'No exite delitos.';
                    \Log::warning('CONSULTA DELITOS I4: No exite delitos.');
                    return $respuesta;
                }

            // === CODIGO MUNICIPIO ===
                $municipio = UbgeMunicipio::where('id', $hecho->municipio_id)->select('codigo')->first();
                if ($municipio === null)
                {   $muni = 0;
                    $respuesta['mensaje'] = 'No exite el municipio.';
                    \Log::warning('CONSULTA CODIGO MUNICIPIO: No exite municipio.');
                }else{$muni = $municipio->codigo;}

            // === CODIGO DIVISION ===
                $division = PolDivision::where('id', $hecho->division_id)->select('nombre')->first();
                if ($division === null)
                {   $divi = 0;
                    $respuesta['mensaje'] = 'No exite el division.';
                    \Log::warning('CONSULTA CODIGO DIVISION: No exite division.');
                }else{$divi = $division->nombre;}

        // === ARMADO DE JSON ===
            // === ACTIVIDADES ===
                $actividades = array();

                foreach ($arrayActividades as $key => $value )
                {
                    $file_name = 'farruco_calma.mp3';
                    $file = public_path('/storage/agenda'). "/" . $file_name;

                    if (!file_exists($file))
                    {
                        $respuesta['mensaje'] = 'No exite el documento.';
                        \Log::warning('ARMADO DE JSON - ACTIVIDADES: No exite el documento.');
                        return $respuesta;
                    }

                    $b64Doc = base64_encode(file_get_contents($file));

                    $actividades[] = [
                            'idTipoActividad'=> $value->TipoActividad,
                            'codigo'         => $value->id,
                            'fecha'          => $value->Fecha,
                            'descripcion'    => $value->Actividad,
                            'extension'      => 'mp3',
                            'archivo'        => $b64Doc,
                    ];
                }

            // === DELITOS ===
                $delito = array();
                $bandera= false;

                foreach ($arrayDelitos as $valor)
                {
                    if (!($casoi4 === null))
                    {
                        if (!($casoi4->DelitoPrincipal == null || $casoi4->DelitoPrincipal == '' ))
                        {
                            if ($casoi4->DelitoPrincipal == $valor->delito_id)
                            {
                                $bandera = true;
                            }
                        }
                    }

                    $delito[] = [
                        'idDelito'   => $valor->delito_codigo,
                        'esPrincipal'=> $bandera,
                    ];

                    $bandera= false;
                }

                //=== VALIDACIONES NULL A 0 ===
                    if ($hecho->tipo_denuncia_id === null) {
                        $tipoDenuncia_id = 0;
                    }else{$tipoDenuncia_id = $hecho->tipo_denuncia_id;}

        // === JSON CASO ===
            $queryParams = [
                'codigoUnico'        => $hecho->codigo,
                'idTipoDenuncia'     => $tipoDenuncia_id,
                'idOficinaMp'        => $hecho->oficina_id,
                'idOficinaMpSc'      => $hecho->oficina_id,
                'idEtapaCaso'        => $hecho->hecho_etapa_id,
                'idEstadoCaso'       => $hecho->hecho_estado_id,
                'relato'             => $hecho->relato,
                'conducta'           => $hecho->conducta,
                'resultado'          => $hecho->resultado,
                'circunstancia'      => $hecho->circunstancia,
                'direccionCaso'      => $hecho->direccion,
                'zona'               => $hecho->zona,
                'detalleLocalizacion'=> $hecho->detallelocacion,
                'codigoMunicipio'    => $muni,
                'division'           => $divi,
                'fechaCreacionFud'   => \Carbon\Carbon::parse($hecho->created_at)->format('Y-m-d H:i:s'),
                'longitud'           => $hecho->longitude,
                'latitud'            => $hecho->latitude,
                'fechaHoraInicio'    => $hecho->fechahorainicio,
                'fechaHoraFin'       => $hecho->fechahorafin,
                'momentoAproximado'  => $hecho->aproximado,
                'titulo'             => $hecho->titulo,
                'quienHizo'          => $hecho->quien_hizo,
                'queHizo'            => $hecho->que_hizo,
                'aquienHizo'         => $hecho->aquien_hizo,
                'comoHizo'           => $hecho->como_hizo,
                'Actividad'          => $actividades,
                'CasoDelito'         => $delito
            ];
            return $queryParams;
            $deco = json_encode($queryParams);

        // === INICIAR VARIABLES PARA EL CONSUMO ===
            /*
            $headers = [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Authorization'=> 'Bearer '.env('DAF_OJ_TOKEN'),
            ];
            */
            $headers = ['Content-Type' => 'application/json;charset=UTF-8',
                        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                        ];

            $client = new Client();

        // === CONSUMIENDO SERVICIO ===
            try
            {
                /*
                $response = $client->post(env('DAF_OJ_URL') . '/api/casos',[
                    'headers'=> $headers,
                    'body'   => $deco,
                ]);
                */
                $response = $client->post('http://wseforo.organojudicial.gob.bo/api/casos',[
                        'headers' => $headers,
                        'body' => $deco
                ]);

                $res = $response->getBody()->getContents();

                \Log::warning($res);

                $api_respuesta = json_decode($res);



                switch ($api_respuesta->codigo)
                {
                    case 201:
                        $respuesta['api_respuesta']= $api_respuesta;
                        $respuesta['mensaje']      = 'Se logró consumir el servicio.';
                        $respuesta['sw']           = true;
                        $hecho->jusgado_id         = $api_respuesta->idJuzgado;
                        $hecho->save();
                        break;
                    case 202:
                        $respuesta['api_respuesta']= $api_respuesta;
                        $respuesta['mensaje']      = 'El caso ya se mando con anterioridad.';
                        $respuesta['sw']           = true;
                        $hecho->jusgado_id         = $api_respuesta->idJuzgado;
                        $hecho->save();
                        break;
                    case 400:
                        $respuesta['api_respuesta']= $api_respuesta;
                        $respuesta['mensaje']      = 'No se logró mandar los datos al servicio.';

                        break;
                    default:
                        $respuesta['api_respuesta']= $api_respuesta;
                        $respuesta['mensaje']      = 'No se logró mandar los datos al servicio.';


                }

            }
            catch (ClientException $e)
            {
                // dd(json_decode($e->getResponse()->getBody()->getContents(), TRUE));

                $respuesta['api_respuesta']= json_decode($e->getResponse()->getBody()->getContents());
                $respuesta['mensaje']      = 'Error en la respuesta del servicio.';
            }

        \Log::warning($respuesta);
        return $respuesta;

    }

    public static function inserSujetosProcesales($hecho_id)
    {
        // === INICIALIZACION DE VARIABLES ===
            $respuesta = array(
                'sw'            => false,
                'mensaje'       => '',
                'api_respuesta' => ''
            );
        // === CONSULTAS ===
            // === HECHO TRITON ===
                $hecho = Hecho::find($hecho_id);
                if ($hecho === null)
                {
                    $respuesta['mensaje'] = 'El hecho no exite.';
                    \Log::warning('CONSULTA HECHO TRITON: El hecho no exite.');
                    return $respuesta;
                }

            // === HECHO PERSONAS TRITON ===
                $hechopersona = Sujeto::where('hecho_id',$hecho_id)->get();
                if ($hechopersona->isEmpty())
                {
                    $respuesta['mensaje'] = 'No exite sujetos en este caso.';
                    \Log::warning('CONSULTA HECHO PERSONAS TRITON: no exite personas.');
                    return $respuesta;
                }

            // === CASO - FUNCIONARIO I4 ===
                $casoFuncionario = CasoFuncionario::where('Caso',$hecho->i4_caso_id)->select('Funcionario')->first();
                if ($casoFuncionario === null)
                {
                    $respuesta['mensaje'] = 'No exite funcionaro en este caso.';
                    \Log::warning('CASO FUNCIONARIO I4: No exite el funcionaro en este caso.');
                    return $respuesta;
                }

                // === FUNCIONARIO I4 ===
                $funcionarioasig = Funcionario::where('id', $casoFuncionario->Funcionario)->first();
                if ($funcionarioasig === null)
                {
                    $respuesta['mensaje'] = 'No exite funcionaro.';
                    \Log::warning('FUNCIONARIO I4: No exite el funcionaro.');
                    return $respuesta;
                }

                // === ARMADO DE JSON SUJETOS ===
                $queryParams = array();
                foreach ($hechopersona as $value)
                {
                        //===  VALIDACIONES CONVERCION DE NULL A 0 ===
                            if ($value->relacion_victima_id === null)
                            {
                                $relacionVictima = 0;
                            }else{$relacionVictima = $value->relacion_victima_id;}

                            if ($value->nivel_educacion_id === null)
                            {
                                $nivelEducacion = 0;
                            }else{$nivelEducacion = $value->nivel_educacion_id;}

                            if ($value->grupo_vulnerable_id === null)
                            {
                                $grupoVulnerable = 0;
                            }else{$grupoVulnerable = $value->grupo_vulnerable_id;}

                            if ($value->grado_discapacidad_id === null)
                            {
                                $gradoDiscacidad = 0;
                            }else{$gradoDiscacidad = $value->grado_discapacidad_id;}

                            if ($value->tipo_sujeto_id === null)
                            {
                                $tipoSujeto = 0;
                            }else{$tipoSujeto = $value->tipo_sujeto_id;}

                            if ($value->autoidentificacion_id === null)
                            {
                                $autoIdentificacion = 0;
                            }else{$autoIdentificacion = $value->autoidentificacion_id;}

                            if ($value->estado_procesal === null)
                            {
                                $estadoProce = 0;
                            }else{$estadoProce = $value->estado_procesal;}

                    if ($value->persona_id != null)
                    {
                        // === VALIDACIONES DE  LA PERSONA
                            $personaNatural = self::getPersonaNatural($value->persona_id, $value->fallecida);
                            if ($personaNatural === false)
                            {
                                $respuesta['mensaje'] = 'No exite persona Natural.';
                                \Log::warning('METODO NOT FOUNT: getPersonaNatural return false.');
                                return $respuesta;
                            }

                            if ($value->es_victima === 1 || $value->tipo_sujeto_id === 3)
                            {
                                $medidasProteccion = self::getMedidas($value->id);
                            }else
                            {
                                $medidasProteccion = [];
                            }

                            $estadoLibertad = HistoricoEstadoLibertad::where('hecho_persona_id', $value->id)->orderBy('fecha_hora','desc')->first();
                            if ($estadoLibertad === null)
                            {
                                $libertadEstadoId = 1;
                                $libertadFecha = null;
                                \Log::warning('METODO NOT FOUNT: HistoricoEstadoLibertad return null.');
                            }else
                            {
                                $libertadEstadoId = $estadoLibertad->estado_libertad_id;
                                $libertadFecha = $estadoLibertad->fecha_hora;
                            }

                        if ($value->tipo_sujeto_id === 4)
                        {
                            $queryParams[] = [
                                'idRelacionVictima'   => $relacionVictima,
                                'idNivelEducacion'    => $nivelEducacion,
                                'idGrupoVulnerable'   => $grupoVulnerable,
                                'idGradoDiscapacidad' => $gradoDiscacidad,
                                'idTipoParte'         => $tipoSujeto,
                                'idEstadoLibertad'    => $libertadEstadoId,
                                'idAutoidentificacion'=> $autoIdentificacion,
                                'fechaEstadoProcesal' => \Carbon\Carbon::parse($libertadFecha)->format('Y-m-d H:i:s'),
                                'Tercero'             => $personaNatural
                            ];
                        }else
                        {
                            $queryParams[] = [
                                'idRelacionVictima'   => $relacionVictima,
                                'idNivelEducacion'    => $nivelEducacion,
                                'idGrupoVulnerable'   => $grupoVulnerable,
                                'idGradoDiscapacidad' => $gradoDiscacidad,
                                'idTipoParte'         => $tipoSujeto,
                                'idEstadoLibertad'    => $libertadEstadoId,
                                'idAutoidentificacion'=> $autoIdentificacion,
                                'fechaEstadoProcesal' => \Carbon\Carbon::parse($libertadFecha)->format('Y-m-d H:i:s'),
                                'estadoProcesal'      => $estadoProce,
                                'PersonaNatural'      => $personaNatural,
                                'MedidaProteccion'    => $medidasProteccion
                            ];
                        }

                    }elseif ($value->persona_juridica_id != null)
                    {

                        $personaJuridica = self::getPersonaJuridica($value->persona_juridica_id);
                        if ($personaJuridica === false)
                        {
                                $respuesta['mensaje'] = 'No exite persona Juridica.';
                                \Log::warning('METODO NOT FOUNT: getPersonaJuridica return false.');
                                return $respuesta;
                        }

                        if ($value->es_victima === 1 || $value->tipo_sujeto_id === 3)
                        {
                            $medidasProteccion = self::getMedidas($value->id);
                        }else
                        {
                            $medidasProteccion = [];
                        }
                        $queryParams[] = [
                            'idRelacionVictima'   => $relacionVictima,
                            'idNivelEducacion'    => $nivelEducacion,
                            'idGrupoVulnerable'   => $grupoVulnerable,
                            'idGradoDiscapacidad' => $gradoDiscacidad,
                            'idTipoParte'         => $tipoSujeto,
                            'idEstadoLibertad'    => 1,
                            'idAutoidentificacion'=> $autoIdentificacion,
                            'fechaEstadoProcesal' => \Carbon\Carbon::parse($value->fecha_estado_procesal)->format('Y-m-d H:i:s'),
                            'estadoProcesal'      => $estadoProce,
                            'personaJuridica'     => $personaJuridica,
                            'MedidaProteccion'    => $medidasProteccion
                        ];

                    }elseif ($value->persona_desconocida_id != null)
                    {

                        $personaDesconocida = self::getPersonaDesconocida($value->persona_desconocida_id,$value->fallecida);
                        if ($personaDesconocida === false) {
                                $respuesta['mensaje'] = 'No exite persona desconocida.';
                                \Log::warning('METODO NOT FOUNT: getPersonaDesconocida return false.');
                                return $respuesta;
                        }

                        if ($value->es_victima === 1 || $value->tipo_sujeto_id === 3)
                        {
                            $medidasProteccion = self::getMedidas($value->id);
                        }else
                        {
                            $medidasProteccion = [];
                        }

                        $estadoLibertad = HistoricoEstadoLibertad::where('hecho_persona_id', $value->id)->orderBy('fecha_hora','desc')->first();
                        if ($estadoLibertad === null)
                        {
                            $libertadEstadoId = 1;
                            $libertadFecha = null;
                            \Log::warning('METODO NOT FOUNT: HistoricoEstadoLibertad return null.');
                        }else
                        {
                            $libertadEstadoId = $estadoLibertad->estado_libertad_id;
                            $libertadFecha = $estadoLibertad->fecha_hora;
                        }

                        if ($value->tipo_sujeto_id === 4)
                        {
                            $queryParams[] = [
                                'idRelacionVictima'   => $relacionVictima,
                                'idNivelEducacion'    => $nivelEducacion,
                                'idGrupoVulnerable'   => $grupoVulnerable,
                                'idGradoDiscapacidad' => $gradoDiscacidad,
                                'idTipoParte'         => $tipoSujeto,
                                'idEstadoLibertad'    => $libertadEstadoId,
                                'idAutoidentificacion'=> $autoIdentificacion,
                                'fechaEstadoProcesal' => \Carbon\Carbon::parse($libertadFecha)->format('Y-m-d H:i:s'),
                                'Tercero'             => $personaDesconocida,
                                'MedidaProteccion'    => $medidasProteccion
                            ];
                        }else
                        {
                            $queryParams[] = [
                                'idRelacionVictima'   => $relacionVictima,
                                'idNivelEducacion'    => $nivelEducacion,
                                'idGrupoVulnerable'   => $grupoVulnerable,
                                'idGradoDiscapacidad' => $gradoDiscacidad,
                                'idTipoParte'         => $tipoSujeto,
                                'idEstadoLibertad'    => $libertadEstadoId,
                                'idAutoidentificacion'=> $autoIdentificacion,
                                'fechaEstadoProcesal' => \Carbon\Carbon::parse($value->fecha_estado_procesal)->format('Y-m-d H:i:s'),
                                'estadoProcesal'      => $estadoProce,
                                'PersonaNatural'      => $personaDesconocida,
                                'MedidaProteccion'    => $medidasProteccion
                            ];
                        }
                    }else
                    {
                        $respuesta['mensaje'] = 'No exite sujetos en este caso.';
                        \Log::warning('ARMADO DE JSON PERSONAS: no exite personas.');
                        return $respuesta;
                    }
                }

                // === ARMADO DE JSON FISCAL ASIGNADO ===
                $queryParams []=[
                        "idRelacionVictima"=> 0,
                        "idNivelEducacion"=> 0,
                        "idGrupoVulnerable"=> 0,
                        "idGradoDiscapacidad"=> 0,
                        "idTipoParte"=> 6,
                        "idEstadoLibertad"=> 1,
                        "idAutoidentificacion"=> 0,
                        "fechaEstadoProcesal"=> null,
                        "estadoProcesal"=> 0,
                        "Tercero"=> [
                            "ci"=> $funcionarioasig->NumDocId,
                            "nombres"=> $funcionarioasig->Nombres,
                            "primerApellido"=> $funcionarioasig->ApPat,
                            "segundoApellido"=> $funcionarioasig->ApMat,
                            "fechaNacimiento"=> $funcionarioasig->FechaNac
                        ]
                ];
                // === COMSUMO DEL SERVICIO ===
                return $queryParams;
                try
                {
                     \Log::warning('entro de try');
                    \Log::warning($queryParams);
                    $deco = json_encode($queryParams);
                    $client = new Client();
                    /*
                    $headers = ['Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('DAF_OJ_TOKEN'),
                    ];
                    $response = $client->post(env('DAF_OJ_URL') . '/api/sujetosProcesales/'.$hecho->codigo,[
                        'headers' => $headers,
                        'body' => $deco
                    ]);
                    */
                    $headers = ['Content-Type' => 'application/json;charset=UTF-8',
                                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                                ];
                    $response = $client->post('http://wseforo.organojudicial.gob.bo/api/sujetosProcesales/'.$hecho->codigo,[
                                'headers' => $headers,
                                'body' => $deco
                        ]);

                    $res = $response->getBody()->getContents();
                    \Log::warning($res);
                    $api_respuesta = json_decode($res);

                    switch ($api_respuesta->codigo)
                    {
                        case '201':
                            $respuesta['api_respuesta']= $api_respuesta;
                            $respuesta['mensaje']      = 'Se logró consumir el servicio.';
                            $respuesta['sw']           = true;
                            break;
                        case '400':
                            $respuesta['api_respuesta']= $api_respuesta;
                            $respuesta['mensaje']      = 'No se logró mandar los datos al servicio.';
                            $respuesta['sw']           = false;
                            break;
                    }
                } catch (ClientException $e)
                {
                    // dd(json_decode($e->getResponse()->getBody()->getContents(), TRUE));
                    $respuesta['api_respuesta']= json_decode($e->getResponse()->getBody()->getContents());
                    $respuesta['mensaje']      = 'Error en la respuesta del servicio.';
                }
                \Log::warning($respuesta);
                return $respuesta;
    }

    public static function getMedidas($hechoPersonaId)
    {
        // === CONSULTA MEDIDAS DE PROTECCION ===
            $medidas = PersonaMedidasProteccion::where('hechopersona_id',$hechoPersonaId)->get();
            if ($medidas->isEmpty())
            {
                return [];
            }
        // === ARMADO JSON MEDIDAS DE PROTECCION ===
            $medidasGet = array();
            foreach ($medidas as $key => $value)
            {
                $codigoMedida = MedidaProteccion::where('id',$value->medidaproteccion_id)->first();
                $medidasGet[] = [
                    'idTipoMedidaProteccion'=> $codigoMedida->id,
                    'tipo'                  => $codigoMedida->tipo,
                    'inciso'                => $codigoMedida->inciso,
                ];
            }
        return $medidasGet;
    }

    public static function getPersonaNatural($id, $fallecida)
    {
        // === CONSULTA PERSONA NATURAL ===
            $persona = RrhhPersona::where('id',$id)->first();
            if ($persona === null)
            {
                return false;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a RrhhPersona null en la funcion getPersonaNatural.');
            }

        // === CONSULTA MUNICIPIO NACIMIENTO ===
            $nacimiento = UbgeMunicipio::where('id',$persona->municipio_id_nacimiento)->first();
            if ($nacimiento === null)
            {
                $naci = 0;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a UbgeMunicipio null en la funcion getPersonaNatural.');
            }else{$naci = $nacimiento->codigo;}

        // === CONSULTA MUNICIPIO NACIMIENTO ===
            $residencia = UbgeMunicipio::where('id',$persona->municipio_id_residencia)->first();
            if ($residencia === null)
            {
                $resi = 0;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a UbgeMunicipio null en la funcion getPersonaNatural.');
            }else{$resi = $residencia->codigo;}

        // ===  VALIDACION NULL CONVERCION A 0 ===
            if ($persona->estado_civil === null) {
                $estadoCivil = 0;
            }else{$estadoCivil = $persona->estado_civil;}

            if ($persona->pueblo_originario === null) {
                $puebloOriginario = 0;
            }else{$puebloOriginario = $persona->pueblo_originario;}

            if ($persona->idioma_id === null) {
                $idioma = 0;
            }else{$idioma = $persona->idioma_id;}

            if ($persona->pais_id === null) {
                $pais = 0;
            }else{$pais = $persona->pais_id;}


        // === ARMADO JSON PERSONA NATURAL ===
            return $getPersoana=[
                        'idPersonaNatural'         => $persona->id,
                        'codigoMunicipioNacimiento'=> $naci,
                        'codigoMunicipioResidencia'=> $resi,
                        'idTipoDocumento'          => $persona->tipo_documento_id,
                        'numeroDocumento'          => $persona->n_documento,
                        'nombres'                  => $persona->nombre,
                        'primerApellido'           => $persona->ap_paterno,
                        'segundoApellido'          => $persona->ap_materno,
                        'apellidoEsposo'           => $persona->ap_esposo,
                        'sexo'                     => $persona->sexo,
                        'fechaNacimiento'          => $persona->f_nacimiento,
                        'estadoCivil'              => $estadoCivil,//este
                        'domicilio'                => $persona->domicilio,
                        'telefono'                 => $persona->telefono,
                        'celular'                  => $persona->celular,
                        'estadoSegip'              => $persona->estado_segip,
                        'profesionOcupacion'       => $persona->profesion_ocupacion,
                        'puebloOriginario'         => $puebloOriginario,//este
                        'lugarTrabajo'             => $persona->lugar_trabajo,
                        'domicilioLaboral'         => $persona->domicilio_laboral,
                        'telefonoLaboral'          => $persona->telf_laboral,
                        'alias'                    => $persona->alias,
                        'estatura'                 => $persona->estatura,
                        'tez'                      => $persona->tez,
                        'edad'                     => $persona->edad,
                        'vestimenta'               => $persona->vestimenta,
                        'senia'                    => $persona->senia,
                        'peso'                     => $persona->peso,
                        'cabello'                  => $persona->cabello,
                        'genero'                   => $persona->genero,
                        'email'                    => $persona->email,
                        'ojos'                     => $persona->ojos,
                        'idIdioma'                 => $idioma,//este
                        'idPais'                   => $pais,//este
                        'fallecido'                => $fallecida,
                        'mapLatitud'               => $persona->map_latitud,
                        'mapLongitud'              => $persona->map_longitud,
                        'ciudadanoDigital'         => $persona->es_ciudadano_digital,
                        'aprobadoCd'               => $persona->aprobado_cd,
                        'esDesconocida'            => false
                    ];
    }

    public static function getPersonaJuridica($id)
    {
        // === CONSULTA PERSONA JURIDICA ===
            $juridica = RrhhPersonaJuridica::where('id',$id)->first();
            if ($juridica === null)
            {
                return false;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a RrhhPersonaJuridica null en la funcion getPersonaJuridica.');
            }

        // === CONSULTA REPRESENTANTE LEGAL ===
            $juridacaRepresentante = RepresentanteLegal::where('persona_juridica_id',$id)->orderByRaw('updated_at - created_at DESC')->first();
            if ($juridacaRepresentante === null)
            {
                $perLegalCi = 0;
                $nombreLegal= 0;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a RepresentanteLegal null en la funcion getPersonaJuridica.');
            }else
            {
                $PersonaLegal= RrhhPersona::where('id',$juridacaRepresentante->persona_id)->first();
                $perLegalCi  = $PersonaLegal->n_documento;
                $nombreLegal = $PersonaLegal->nombre.' '.$PersonaLegal->ap_paterno.' '.$PersonaLegal->ap_materno;
            }

        // === CONSULTA MUNICIPIO ===
            $numicipio = UbgeMunicipio::where('id',$juridica->municipio_id)->first();
            if ($numicipio === null)
            {
                $muni = 0;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a UbgeMunicipio null en la funcion getPersonaJuridica.');
            }else{$muni = $numicipio->codigo;}

        // === ARMADO JSON PERSONA JURIDICA ===
            return $getjuridica = [
                        'idPersonaJuridica'        => $juridica->id,
                        'codigoMunicipio'          => $muni,
                        'codigoMunicipioResidencia'=> $muni,
                        'nit'                      => $juridica->nit,
                        'razonSocial'              => $juridica->razon_social,
                        'domicilio'                => $juridica->domicilio,
                        'telefono'                 => $juridica->telefono,
                        'email'                    => $juridica->email,
                        'mapLatitud'               => $juridica->map_latitud,
                        'mapLongitud'              => $juridica->map_longitud,
                        'ciRepresentante'          => $perLegalCi,
                        'nombreRepresentante'      => $nombreLegal
                    ];
    }

    public static function getPersonaDesconocida($id, $fallecida)
    {
        // === CONSULTA PERSONA DESCONOCIDA ===
            $persona = RrhhPersonaDesconocida::where('id',$id)->first();
            if ($persona === null)
            {
                return false;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a RrhhPersonaDesconocida null en la funcion getPersonaDesconocida.');
            }

        // === CONSULTA MUNICIPIO NACIMIENTO PERSONA DESCONOCIDA ===
            $nacimiento = UbgeMunicipio::where('id',$persona->municipio_id_nacimiento)->first();
            if ($nacimiento === null)
            {
                $naci = 0;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a UbgeMunicipio null en la funcion getPersonaDesconocida.');
            }else
            {
                $naci = $nacimiento->codigo;
            }

        // === CONSULTA MUNICIPIO RECIDENCIA PERSONA DESCONOCIDA ===
            $residencia = UbgeMunicipio::where('id',$persona->municipio_id_residencia)->first();
            if ($residencia === null)
            {
                $recide = 0;
                \Log::warning('ARMADO DE JSON PERSONAS: consulta a UbgeMunicipio null en la funcion getPersonaDesconocida.');
            }else
            {
                $recide = $residencia->codigo;
            }
        //=== CONVERSION DE NULL A 0 ===
            if ($persona->estado_civil === null) {
                $estadoCivil = 0;
            }else{$estadoCivil = $persona->estado_civil;}

            if ($persona->pueblo_originario === null) {
                $puebloOriginario = 0;
            }else{$puebloOriginario = $persona->pueblo_originario;}

            if ($persona->idioma_id === null) {
                $idioma = 0;
            }else{$idioma = $persona->idioma_id;}

            if ($persona->pais_id === null) {
                $pais = 0;
            }else{$pais = $persona->pais_id;}

        // === ARMADO JSON PERSONA DESCONOCIDA ===
            return $getPersoana = [
                        'idPersonaNatural'         => $persona->id,
                        'codigoMunicipioNacimiento'=> $naci,
                        'codigoMunicipioResidencia'=> $recide,
                        'idTipoDocumento'          => $persona->tipo_documento_id,
                        'numeroDocumento'          => $persona->n_documento,
                        'nombres'                  => $persona->nombre,
                        'primerApellido'           => $persona->ap_paterno,
                        'segundoApellido'          => $persona->ap_materno,
                        'apellidoEsposo'           => $persona->ap_esposo,
                        'sexo'                     => $persona->sexo,
                        'fechaNacimiento'          => $persona->f_nacimiento,
                        'estadoCivil'              => $estadoCivil,//este
                        'domicilio'                => $persona->domicilio,
                        'telefono'                 => $persona->telefono,
                        'celular'                  => $persona->celular,
                        'estadoSegip'              => $persona->estado_segip,
                        'profesionOcupacion'       => $persona->profesion_ocupacion,
                        'puebloOriginario'         => $puebloOriginario,//este
                        'lugarTrabajo'             => $persona->lugar_trabajo,
                        'domicilioLaboral'         => $persona->domicilio_laboral,
                        'telefonoLaboral'          => $persona->telf_laboral,
                        'alias'                    => $persona->alias,
                        'estatura'                 => $persona->estatura,
                        'tez'                      => $persona->tez,
                        'edad'                     => $persona->edad,
                        'vestimenta'               => $persona->vestimenta,
                        'senia'                    => $persona->senia,
                        'peso'                     => $persona->peso,
                        'cabello'                  => $persona->cabello,
                        'genero'                   => $persona->genero,
                        'email'                    => $persona->email,
                        'ojos'                     => $persona->ojos,
                        'idIdioma'                 => $idioma,//este
                        'idPais'                   => $pais,//este
                        'fallecido'                => $fallecida,
                        'mapLatitud'               => $persona->map_latitud,
                        'mapLongitud'              => $persona->map_longitud,
                        'ciudadanoDigital'         => 0,
                        'aprobadoCd'               => 0,
                        'esDesconocida'            => false
                    ];
    }


}
