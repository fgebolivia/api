<?php

namespace App\Helpers;

use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\HistoricoEstadoLibertad;
use App\Models\Denuncia\MedidaProteccion;
use App\Models\Denuncia\PersonaMedidasProteccion;
use App\Models\Denuncia\PolDivision;
use App\Models\Denuncia\RepresentanteLegal;
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
        try{
                $hecho = Hecho::where('i4_caso_id',$casoId)->first();
                //$sql = "SELECT * FROM Caso where Caso ='".$casoId."'"; //FIS-BENI1901872
                //$casoi4 = DB::connection('mysql')->statement($sql);
                $casoi4 = Caso::find($casoId);//coneccion mediante la carpeta config arcivo database.php
                //$sqlActividad = "SELECT * FROM i4bol.Actividad where Caso =". $casoi4->id."and (TipoActividad = 861 or TipoActividad = 1023)"; //FIS-BENI1901872
                //$arrayActividades = DB::connection('mysql')->statement($sqlActividad);
                $arrayActividades = Actividad::where('Caso',$casoi4->id)->get();//coneccion mediante arcivo database.php

                //$sqlDelitos= "SELECT * FROM i4bol.CasoDelito where Caso =". $casoi4->id; //FIS-BENI1901872
                //$arrayDelitos = DB::connection('mysql')->statement($sqlDelitos);
                $arrayDelitos =CasoDelito::where('Caso',$casoi4->id)->get();//sacar del i4

                //dd($arrayActividades);
                $actividades = array();
                foreach ($arrayActividades as $key => $value ) {
                    $file_name = 'Prueba.pdf';
                    $file      = public_path('/storage/agenda'). "/" . $file_name;
                    $b64Doc = base64_encode(file_get_contents($file));
                    //$b64Doc = base64_encode(file_get_contents($file));
                    $actividades []=[
                            'idTipoActividad' => $value->TipoActividad,
                            'codigo' => $value->id,
                            'fecha' => $value->Fecha,
                            'descripcion' => $value->Actividad,
                            'archivo' => $b64Doc,//base64_encode($value->Documento),
                        ];
                }

                $delito = array();
                $bandera= true;
                foreach ($arrayDelitos as $row => $valor) {
                    $del = Delito::where('id',$valor->Delito)->first();

                    $delito []=[
                            'idDelito' => $del->codigo,
                            'esPrincipal' => $bandera,
                        ];
                    $bandera= false;
                }

                $municipio = UbgeMunicipio::where('id',$hecho->municipio_id)->first();
                $division = PolDivision::where('id',$hecho->division_id)->first();

                $headers = ['Content-Type' => 'application/json;charset=UTF-8',
                        'Authorization' => 'Bearer '.env('AGETIC_INTEROPERABILIDAD_URL'),
                        ];

                 $queryParams = [
                        'codigoUnico'        => $hecho->codigo,
                        'idTipoDenuncia'     => $hecho->tipo_denuncia_id,
                        'idOficinaMp'        => $hecho->oficina_id,
                        'idOficinaMpSc'      => $hecho->oficina_id,
                        'idEtapaCaso'        => $hecho->hecho_etapa_id,
                        'idEstadoCaso'       => $hecho->hecho_estado_id,
                        'relato'             => $hecho->relato,
                        'conducta'           =>$hecho->conducta,
                        'resultado'          =>$hecho->resultado,
                        'circunstancia'      =>$hecho->circunstancia,
                        'direccionCaso'      => $hecho->direccion,
                        'zona'               => $hecho->zona,
                        'detalleLocalizacion'=> $hecho->detallelocacion,
                        'codigoMunicipio'    => $municipio->codigo,
                        'division'           => $division->nombre,
                        'fechaCreacionFud'   => $hecho->created_at,
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
            //dd($queryParams);
                  return $queryParams;
                    $deco = json_encode($queryParams);

                    $client = new Client();

                    $response = $client->post('http://wseforo.organojudicial.gob.bo/api/casos',[
                        'headers' => $headers,
                        'body' => $deco
                    ]);
                $respuesta = $response->getBody()->getContents();

                //return $respuesta;
                $deco = json_decode($respuesta);
                if ($deco->codigo >= 200 && $deco->codigo <=300) {
                    $hecho->jusgado_id = $deco->idJuzgado;
                    $hecho->save();
                    return 1;

                }else{
                    return 0;
                }


            } catch (Exception $e) {
            return 0;
        }
    }


    public static function inserSujetosProcesales($hecho_id)
    {
        $hecho = Hecho::find($hecho_id);
        $hechopersona = HechoPersona::where('hecho_id',$hecho_id)->get();

        $queryParams = array();

        $fical ='Roberto Almarado';
        $fical2 ='Almarado';
        $fical3 ='Contreras';

        foreach ($hechopersona as $key => $value) {

            if ($value->persona_id != null) {

                $personaNatural = self::getPersonaNatural($value->persona_id);

                if ($value->es_victima === 1 || $value->tipo_sujeto_id === 3) {
                    $medidasProteccion = self::getMedidas($value->id);
                }else{
                    $medidasProteccion = [];
                }
                $estadoLibertad = HistoricoEstadoLibertad::where('hecho_persona_id', $value->id)->orderBy('fecha_hora','desc')->first();
                    if ($estadoLibertad === null)
                    {
                        $libertadEstadoId = null;
                        $libertadFecha = null;
                    }else
                    {
                        $libertadEstadoId = $value->estado_libertad_id;
                        $libertadFecha = $estadoLibertad->fecha_hora;
                    }

                if ($value->tipo_sujeto_id === 4) {
                    $queryParams []=[
                        'idRelacionVictima' => $value->relacion_victima_id,
                        'idNivelEducacion' => $value->nivel_educacion_id,
                        'idGrupoVulnerable' => $value->grupo_vulnerable_id,
                        'idGradoDiscapacidad' => $value->grado_discapacidad_id,
                        'idTipoParte' => $value->tipo_sujeto_id,
                        'idEstadoLibertad' => $libertadEstadoId,
                        'idAutoidentificacion' => $value->autoidentificacion_id,
                        'fechaEstadoProcesal' => $libertadFecha,
                        'Tercero' => $personaNatural,
                        'MedidaProteccion' => $medidasProteccion,
                    ];
                }else{

                    $queryParams []=[
                        'idRelacionVictima' => $value->relacion_victima_id,
                        'idNivelEducacion' => $value->nivel_educacion_id,
                        'idGrupoVulnerable' => $value->grupo_vulnerable_id,
                        'idGradoDiscapacidad' => $value->grado_discapacidad_id,
                        'idTipoParte' => $value->tipo_sujeto_id,
                        'idEstadoLibertad' => $libertadEstadoId,
                        'idAutoidentificacion' => $value->autoidentificacion_id,
                        'fechaEstadoProcesal' => $libertadFecha,
                        'estadoProcesal' => $value->estado_procesal,
                        'PersonaNatural' => $personaNatural,
                        'MedidaProteccion' => $medidasProteccion,
                    ];
                }

            }elseif ($value->persona_juridica_id != null) {

                $personaJuridica = self::getPersonaJuridica($value->persona_juridica_id);

                if ($value->es_victima === 1 || $value->tipo_sujeto_id === 3) {
                    $medidasProteccion = self::getMedidas($value->id);
                }else{
                    $medidasProteccion = [];
                }
                $queryParams []=[
                    'idRelacionVictima' => $value->relacion_victima_id,
                    'idNivelEducacion' => $value->nivel_educacion_id,
                    'idGrupoVulnerable' => $value->grupo_vulnerable_id,
                    'idGradoDiscapacidad' => $value->grado_discapacidad_id,
                    'idTipoParte' => $value->tipo_sujeto_id,
                    'idEstadoLibertad' => $value->estado_libertad_id,
                    'idAutoidentificacion' => $value->autoidentificacion_id,
                    'fechaEstadoProcesal' => $value->fecha_estado_procesal,
                    'estadoProcesal' => $value->estado_procesal,
                    'personaJuridica' => $personaJuridica,
                    'MedidaProteccion' => $medidasProteccion,
                ];

            }elseif ($value->persona_desconocida_id != null) {

                $personaDesconocida = self::getPersonaDesconocida($value->persona_desconocida_id);
                if ($value->es_victima === 1 || $value->tipo_sujeto_id === 3) {
                    $medidasProteccion = self::getMedidas($value->id);
                }else{
                    $medidasProteccion = [];
                }

                $estadoLibertad = HistoricoEstadoLibertad::where('hecho_persona_id', $value->id)->orderBy('fecha_hora','desc')->first();
                    if ($estadoLibertad === null)
                    {
                        $libertadEstadoId = null;
                        $libertadFecha = null;
                    }else
                    {
                        $libertadEstadoId = $value->estado_libertad_id;
                        $libertadFecha = $estadoLibertad->fecha_hora;
                    }

                if ($value->tipo_sujeto_id === 4) {
                    $queryParams []=[
                        'idRelacionVictima' => $value->relacion_victima_id,
                        'idNivelEducacion' => $value->nivel_educacion_id,
                        'idGrupoVulnerable' => $value->grupo_vulnerable_id,
                        'idGradoDiscapacidad' => $value->grado_discapacidad_id,
                        'idTipoParte' => $value->tipo_sujeto_id,
                        'idEstadoLibertad' => $libertadEstadoId,
                        'idAutoidentificacion' => $value->autoidentificacion_id,
                        'fechaEstadoProcesal' => $libertadFecha,
                        'Tercero' => $personaDesconocida,
                        'MedidaProteccion' => $medidasProteccion,
                    ];
                }else{
                    $queryParams []=[
                        'idRelacionVictima' => $value->relacion_victima_id,
                        'idNivelEducacion' => $value->nivel_educacion_id,
                        'idGrupoVulnerable' => $value->grupo_vulnerable_id,
                        'idGradoDiscapacidad' => $value->grado_discapacidad_id,
                        'idTipoParte' => $value->tipo_sujeto_id,
                        'idEstadoLibertad' => $libertadEstadoId,
                        'idAutoidentificacion' => $value->autoidentificacion_id,
                        'fechaEstadoProcesal' => $libertadFecha,
                        'estadoProcesal' => $value->estado_procesal,
                        'PersonaNatural' => $personaDesconocida,
                        'MedidaProteccion' => $medidasProteccion,
                    ];
                }
            }

        }
        $casoFuncionario = CasoFuncionario::where('Caso',$hecho->i4_caso_id)->first();
        $funcionarioasig = Funcionario::where('id', $casoFuncionario->Funcionario)->first();
        $queryParams []=[
                "idRelacionVictima"   => null,
                "idNivelEducacion"    => null,
                "idGrupoVulnerable"   => null,
                "idGradoDiscapacidad" => null,
                "idTipoParte"         => 6,
                "idEstadoLibertad"    => null,
                "idAutoidentificacion"=> null,
                "fechaEstadoProcesal" => null,
                "estadoProcesal"      => null,
                "Tercero"=> [
                    "ci"             => $funcionarioasig->NumDocId,
                    "nombres"        => $funcionarioasig->Nombres,
                    "primerApellido" => $funcionarioasig->ApPat,
                    "segundoApellido"=> $funcionarioasig->ApMat,
                    "fechaNacimiento"=> $funcionarioasig->FechaNac
                ]
         ];

        return $queryParams;
        $headers = [
            'Content-Type'     => 'application/json;charset=UTF-8',
                'Authorization'=> 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                ];

            $deco = json_encode($queryParams);

            $client = new Client();

            $response = $client->post('http://wseforo.organojudicial.gob.bo/api/sujetosProcesales/'.$hecho->codigo,[
                'headers' => $headers,
                'body' => $deco
            ]);
        return $response->getBody()->getContents();
    }

    public static function getMedidas($hechoPersonaId){
        $medidas = PersonaMedidasProteccion::where('hechopersona_id',$hechoPersonaId)->get();
        $medidasGet = array();
        foreach ($medidas as $key => $value) {
            $codigoMedida = MedidaProteccion::where('id',$value->medidaproteccion_id)->first();
            $medidasGet[] = [
                'idTipoMedidaProteccion' => $codigoMedida->id,
                'tipo' => $codigoMedida->tipo,
                'inciso' => $codigoMedida->inciso,
            ];
        }
        return $medidasGet;
    }

    public static function getPersonaNatural($id){

        $persona = RrhhPersona::where('id',$id)->first();
        $nacimiento = UbgeMunicipio::where('id',$persona->municipio_id_nacimiento)->first();
        $residencia = UbgeMunicipio::where('id',$persona->municipio_id_residencia)->first();
        //
        return $getPersoana = [
                'idPersonaNatural'         => $persona->id,
                'codigoMunicipioNacimiento'=> $nacimiento->codigo,
                'codigoMunicipioResidencia'=> $residencia->codigo,
                'idTipoDocumento'          => $persona->tipo_documento_id,
                'numeroDocumento'          => $persona->n_documento,
                'nombres'                  => $persona->nombre,
                'primerApellido'           => $persona->ap_paterno,
                'segundoApellido'          => $persona->ap_materno,
                'apellidoEsposo'           => $persona->ap_esposo,
                'sexo'                     => $persona->sexo,
                'fechaNacimiento'          => $persona->f_nacimiento,
                'estadoCivil'              => $persona->estado_civil,
                'domicilio'                => $persona->domicilio,
                'telefono'                 => $persona->telefono,
                'celular'                  => $persona->celular,
                'estadoSegip'              => $persona->estado_segip,
                'profesionOcupacion'       => $persona->profesion_ocupacion,
                'puebloOriginario'         => $persona->pueblo_originario,
                'lugarTrabajo'             =>$persona->lugar_trabajo,
                'domicilioLaboral'         =>$persona->domicilio_laboral,
                'telefonoLaboral'          =>$persona->telf_laboral,
                'alias'                    => $persona->alias,
                'estatura'                 => $persona->estatura,
                'tez'                      => $persona->tez,
                'edad'                     => $persona->edad,
                'vestimenta'               =>$persona->vestimenta,
                'senia'                    =>$persona->senia,
                'peso'                     => $persona->peso,
                'cabello'                  => $persona->cabello,
                'genero'                   => $persona->genero,
                'email'                    => $persona->email,
                'ojos'                     => $persona->ojos,
                'idIdioma'                 => $persona->idioma_id,
                'idPais'                   => $persona->pais_id,
                'fallecido'                => false,//cambiar para hacerlo automatico
                'mapLatitud'               => $persona->map_latitud,
                'mapLongitud'              => $persona->map_longitud,
                'ciudadanoDigital'         => $persona->es_ciudadano_digital,
                'aprobadoCd'               => $persona->aprobado_cd,
                'esDesconocida'            => false,
            ];
    }

    public static function getPersonaJuridica($id){

        $juridica = RrhhPersonaJuridica::where('id',$id)->first();

        $juridacaRepresentante = RepresentanteLegal::where('persona_juridica_id',$id)->orderByRaw('updated_at - created_at DESC')->first();
        $numicipio = UbgeMunicipio::where('id',$juridica->municipio_id)->first();
        if ($juridacaRepresentante === null) {
            $perLegalCi = null;
            $nombreLegal = null;
        }else{
            $PersonaLegal = RrhhPersona::where('id',$juridacaRepresentante->persona_id)->first();
            $perLegalCi = $PersonaLegal->n_documento;
            $nombreLegal = $PersonaLegal->nombre.' '.$PersonaLegal->ap_paterno.' '.$PersonaLegal->ap_materno;
        }

        return $getjuridica =[
            'idPersonaJuridica' => $juridica->id,
            'codigoMunicipio' => $numicipio->codigo,
            'codigoMunicipioResidencia' => $numicipio->codigo,
            'nit' => $juridica->nit,
            'razonSocial' => $juridica->razon_social,
            'domicilio' => $juridica->domicilio,
            'telefono' => $juridica->telefono,
            'email' => $juridica->email,
            'mapLatitud' => $juridica->map_latitud,
            'mapLongitud' => $juridica->map_longitud,
            'ciRepresentante' => $perLegalCi,
            'nombreRepresentante' => $nombreLegal,
        ];
    }

    public static function getPersonaDesconocida($id){

        $persona = RrhhPersonaDesconocida::where('id',$id)->first();
        $nacimiento = UbgeMunicipio::where('id',$persona->municipio_id_nacimiento)->first();
        $residencia = UbgeMunicipio::where('id',$persona->municipio_id_residencia)->first();
        if (!$nacimiento || !$residencia) {
            $recide = null;
            $naci = null;
        }else{
            $recide = $residencia->codigo;
            $naci = $nacimiento->codigo;
        }

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
                'estadoCivil'              => $persona->estado_civil,
                'domicilio'                => $persona->domicilio,
                'telefono'                 => $persona->telefono,
                'celular'                  => $persona->celular,
                'estadoSegip'              => $persona->estado_segip,
                'profesionOcupacion'       => $persona->profesion_ocupacion,
                'puebloOriginario'         => $persona->pueblo_originario,
                'lugarTrabajo'             =>$persona->lugar_trabajo,
                'domicilioLaboral'         =>$persona->domicilio_laboral,
                'telefonoLaboral'          =>$persona->telf_laboral,
                'alias'                    => $persona->alias,
                'estatura'                 => $persona->estatura,
                'tez'                      => $persona->tez,
                'edad'                     => $persona->edad,
                'vestimenta'               =>$persona->vestimenta,
                'senia'                    =>$persona->senia,
                'peso'                     => $persona->peso,
                'cabello'                  => $persona->cabello,
                'genero'                   => $persona->genero,
                'email'                    => $persona->email,
                'ojos'                     => $persona->ojos,
                'idIdioma'                 => $persona->idioma_id,
                'idPais'                   => $persona->pais_id,
                'fallecido'                => false,//cambiar para hacerlo automatico
                'mapLatitud'               => $persona->map_latitud,
                'mapLongitud'              => $persona->map_longitud,
                'ciudadanoDigital'         => null,
                'aprobadoCd'               => null,
                'esDesconocida'            => true,
            ];
    }

}
