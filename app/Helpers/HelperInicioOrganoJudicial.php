<?php

namespace App\Helpers;

use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\MedidaProteccion;
use App\Models\Denuncia\PersonaMedidasProteccion;
use App\Models\Denuncia\RepresentanteLegal;
use App\Models\Notificacion\Actividad;
use App\Models\Notificacion\Caso;
use App\Models\Notificacion\CasoDelito;
use App\Models\Rrhh\RrhhPersona;
use App\Models\Rrhh\RrhhPersonaDesconocida;
use App\Models\Rrhh\RrhhPersonaJuridica;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use GuzzleHttp\Client;

class HelperInicioOrganoJudicial
{
    public static function insertFormularioUnico($caso, $casoId)
    {
        $casoi4 = Caso::where('Caso',$casoId)->first();

        $arrayActividades = Actividad::where('caso',$casoi4->id)->where('TipoActividad',861)->get();
        $arrayDelitos =CasoDelito::where('caso',$casoi4->id)->get();
        //dd($arrayActividades);
        $actividades = array();
        foreach ($arrayActividades as $key => $value ) {
            $file_name = 'Prueba.pdf';
            $file      = public_path('/storage/agenda'). "/" . $file_name;
            $b64Doc = chunk_split(base64_encode(file_get_contents($file)));

            $actividades []=[
                    'idTipoActividad' => $value->TipoActividad,
                    'codigoActividad' => $value->id,
                    'descripcion' => $value->Actividad,
                    'fecha' => $value->Fecha,
                    'archivo' => $b64Doc,//base64_encode($value->Documento),
                ];
        }

        $delito = array();
        foreach ($arrayDelitos as $row => $valor) {
            $delito []=[
                    'idDelito' => $valor->Delito,
                    'esPrincipal' => true,
                ];
        }

        $municipio = UbgeMunicipio::where('id',$caso->municipio_id)->first();

        $headers = ['Content-Type' => 'application/json',
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                ];

         $queryParams = [
                'codigoUnico' => $caso->codigo,
                'relato' => $caso->relato,
                'direccionCaso' => $caso->direccion,
                'detalleLocalizacion' => $caso->detallelocacion,
                'codigoMunicipio' => $municipio->codigo,
                'fechaCreacionFud' => $caso->created_at,
                'longitud' => $caso->longitude,
                'latitud' => $caso->latitude,
                'idTipoDenuncia' => $caso->tipo_denuncia_id,
                'fechaHoraInicio' => $caso->fechahorainicio,
                'fechaHoraFin' => $caso->fechahorafin,
                'momentoAproximado' => $caso->aproximado,
                'idEtapaCaso' => $caso->hecho_etapa_id,
                'idEstadoCaso' => $caso->hecho_estado_id,
                'idOficinaMpSc' => $caso->oficina_id,
                'titulo' => $caso->titulo,

                'Actividad' => $actividades,

                'CasoDelito' => $delito
            ];

            $deco = json_encode($queryParams);

            $client = new Client();

            $response = $client->post('http://wseforo.organojudicial.gob.bo/api/casos',[
                'headers' => $headers,
                'body' => $deco
            ]);
        return $response->getBody()->getContents();
    } 


    public static function inserSujetosProcesales($casoId, $codigo_fud)
    {
        $hechopersona = HechoPersona::where('hecho_id',$casoId)->get();
        
        $queryParams = array();

        foreach ($hechopersona as $key => $value) {
           
            if ($value->persona_id != null) {

                $personaNatural = self::getPersonaNatural($value->persona_id);

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
                    'fechaEstadoProcesal' => $value->fecha_estado_procesal,
                    'estadoProcesal' => $value->estado_procesal,
                    'PersonaNatural' => $personaNatural,
                    'MedidaProteccion' => $medidasProteccion,
                ];

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
                    'fechaEstadoProcesal' => $value->fecha_estado_procesal,
                    'estadoProcesal' => $value->estado_procesal,
                    'PersonaNatural' => $personaJuridica,
                    'MedidaProteccion' => $medidasProteccion,
                ];

            }elseif ($value->persona_desconocida_id != null) {
                
                $personaDesconocida = self::getPersonaDesconocida($value->persona_desconocida_id);

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
                    'fechaEstadoProcesal' => $value->fecha_estado_procesal,
                    'estadoProcesal' => $value->estado_procesal,
                    'PersonaNatural' => $personaDesconocida,
                    'MedidaProteccion' => $medidasProteccion,
                ];
            }            
        }
        //return $queryParams;
        $headers = ['Content-Type' => 'application/json',
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                ];
                
            $deco = json_encode($queryParams);

            $client = new Client();

            $response = $client->post('http://wseforo.organojudicial.gob.bo/api/sujetosProcesales/'.$codigo_fud,[
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
        //
        return $getPersoana=[
                'codigoMunicipioNacimiento' => $persona->municipio_id_nacimiento,
                'codigoMunicipioResidencia' => $persona->municipio_id_residencia,
                'ci' => $persona->n_documento,
                'nombres' => $persona->nombre,
                'primerApellido' => $persona->ap_paterno,
                'segundoApellido' => $persona->ap_materno,
                'apellidoEsposo' => $persona->ap_esposo,
                'sexo' => $persona->sexo,
                'fechaNacimiento' => $persona->f_nacimiento,
                'estadoCivil' => $persona->estado_civil,
                'domicilio' => $persona->domicilio,
                'telefono' => $persona->telefono,
                'celular' => $persona->celular,
                'profesionOcupacion' => $persona->profesion_ocupacion,
                'puebloOriginario' => $persona->pueblo_originario,
                'lugarTrabajo' =>$persona->lugar_trabajo,
                'domicilioLaboral' =>$persona->domicilio_laboral,
                'telefonoLaboral' =>$persona->telf_laboral,
                'alias' => $persona->alias,
                'estatura' => $persona->estatura,
                'tez' => $persona->tez,
                'edad' => $persona->edad,
                'vestimenta' =>$persona->vestimenta,
                'senia' =>$persona->senia,
                'peso' => $persona->peso,
                'cabello' => $persona->cabello,
                'genero' => $persona->genero,
                'email' => $persona->email,
                'ojos' => $persona->ojos,
                'ciudadanoDigital' => $persona->es_ciudadano_digital,
                'esValida' => true,
            ];
    }    

    public static function getPersonaJuridica($id){

        $juridica = RrhhPersonaJuridica::where('id',$id)->first();
        
        $juridacaRepresentante = RepresentanteLegal::where('persona_juridica_id',$id)->orderByRaw('updated_at - created_at DESC')->first();
        if ($juridacaRepresentante === null) {
            $perLegalCi = null;
            $nombreLegal = null;
        }else{
            $PersonaLegal = RrhhPersona::where('id',$juridacaRepresentante->persona_id)->first();
            $perLegalCi = $PersonaLegal->n_documento;
            $nombreLegal = $PersonaLegal->nombre.' '.$PersonaLegal->ap_paterno.' '.$PersonaLegal->ap_materno;
        }

        return $getjuridica =[
            'codigoMunicipio' => $juridica->municipio_id_nacimiento,
            'codigoMunicipioResidencia' => $juridica->municipio_id_residencia,
            'nit' => $juridica->n_documento,
            'razonSocial' => $juridica->nombre,
            'domicilio' => $juridica->n_documento,
            'telefono' => $juridica->nombre,
            'ciRepresentante' => $perLegalCi,
            'nombreRepresentante' => $nombreLegal,
        ];
    }

    public static function getPersonaDesconocida($id){

        $persona = RrhhPersonaDesconocida::where('id',$id)->first();

        return $getPersoana=[
                'codigoMunicipioNacimiento' => $persona->municipio_id_nacimiento,
                'codigoMunicipioResidencia' => $persona->municipio_id_residencia,
                'ci' => $persona->n_documento,
                'nombres' => $persona->nombre,
                'primerApellido' => $persona->ap_paterno,
                'segundoApellido' => $persona->ap_materno,
                'apellidoEsposo' => $persona->ap_esposo,
                'sexo' => $persona->sexo,
                'fechaNacimiento' => $persona->f_nacimiento,
                'estadoCivil' => $persona->estado_civil,
                'domicilio' => $persona->domicilio,
                'telefono' => $persona->telefono,
                'celular' => $persona->celular,
                'profesionOcupacion' => $persona->profesion_ocupacion,
                'puebloOriginario' => $persona->pueblo_originario,
                'lugarTrabajo' =>$persona->lugar_trabajo,
                'domicilioLaboral' =>$persona->domicilio_laboral,
                'telefonoLaboral' =>$persona->telf_laboral,
                'alias' => $persona->alias,
                'estatura' => $persona->estatura,
                'tez' => $persona->tez,
                'edad' => $persona->edad,
                'vestimenta' =>$persona->vestimenta,
                'senia' =>$persona->senia,
                'peso' => $persona->peso,
                'cabello' => $persona->cabello,
                'genero' => $persona->genero,
                'email' => $persona->email,
                'ojos' => $persona->ojos,
                'ciudadanoDigital' => 0,
                'esValida' => false,
            ];
    }
        
}
