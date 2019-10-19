<?php

namespace App\Helpers;

use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\PersonaMedidasProteccion;
use App\Models\Notificacion\Caso;
use App\Models\Rrhh\RrhhPersona;
use App\Models\Rrhh\RrhhPersonaDesconocida;
use App\Models\Rrhh\RrhhPersonaJuridica;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use GuzzleHttp\Client;

class HelperInicioOrganoJudicial
{
    public static function insertFormularioUnico($caso)
    {

        $casoi4 = Caso::where('Caso',$caso->codigo)->first();

        $arrayActividades = Actividad::where('caso',$casoi4->Caso)->get();
        $arrayDelitos =CasoDelito::where('caso',$casoi4->Caso)->get();

        foreach ($arrayActividades as $key) {
            $actividades[] =[
                    'tipo_actividad' => $key->TipoActividad,
                    'codigo_actividad' => $key->id,
                    'descripcion_actividad' => $key->descripcion,
                    'fecha_actividad' => $key->Fecha,
                    'archdocumento_acttividadivo' => '',
                ];
        }

        foreach ($arrayDelitos as $row) {
            $delito[] =[
                    'codigo_delito' => $row->codigo_delito,
                    'es_delito_principal' => $row->es_delito_principal,
                ];
        }

        $municipio = UbgeMunicipio::where('di',$caso->municipio_id)->first();

        $headers = ['Content-Type' => 'application/json'];

         $queryParams = [
                'codigo_fud' => $caso->codigo,

                'actividades' => $actividades,

                'relato' => $caso->relato,
                'direccion_caso' => $caso->direccion,
                'detalle_localizacion' => $caso->detallelocacion,
                'municipio_codigo' => $municipio->codigo,
                'fecha_creacion_fud' => $caso->created_at,
                'longitud' => $caso->longitude,
                'latitud' => $caso->latitude,
                'codigo_tipo_denuncia' => $caso->tipo_denuncia_id,
                'fecha_hora_inicio' => $caso->fechahorainicio,
                'fecha_hora_fin' => $caso->fechahorafin,
                'momento_aproximado' => $caso->aproximado,
                'etapa_caso' => $caso->hecho_etapa_id,
                'estado_caso' => $caso->hecho_estado_id,
                'oficina' => $caso->oficina_id,
                'titulo' => $caso->titulo,

                'delitos' => $delito
            ];

            return $deco = json_encode($queryParams);
            
            $client = new Client();

            $response = $client->post('http://magistratura.organojudicial.gob.bo:8888/wsInteroperabilidadSirej/servicios/formulariounico/v1',[
                'headers' => $headers,
                'body' => $deco
            ]);
        return $response->getBody()->getContents();
    } 


    public static function inserSujetosProcesales($tiposujeto, $arrayHechoPersona)
    {
        foreach ($arrayHechoPersona as $key => $value) {
           
            $arraySujeto[]= ['creacion' => $value->created_at];
        }
        return $arraySujeto;







        /*$hechoPer = HechoPersona::where('hecho_id',$casoCodigo)->get();
        $medidas = array();
        foreach ($hechoPer as $row => $valor) {

            $persona = RrhhPersona::where('id',$valor->persona_id)->first();

            if (!$persona == null) {
                $sujeto []= [
                    'celular' => $persona->celular,
                    'codigo_fud' =>$caso->Caso,
                    'codigo_municipio_residencia' =>$persona->municipio_id_residencia,
                    'codigo_sujeto_procesal' =>$valor->id,
                    'codigo_tipo_sujeto' => $persona->tipo_sujeto_id,
                    'complemento' => '',
                    'correo_electronico' => $persona->email,
                    'domicilio' => $persona->domicilio,
                    'es_ciudadano_digital' => $persona->es_ciudadano_digital,
                    'fecha_nacimiento' => $persona->f_nacimiento,
                    'genero' => $persona->genero,
                    'nombre_sujeto_procesal' => $valor->busqueda_nombre,
                    'nombres' => $persona->nombre,
                    'numero_documento' => $persona->n_documento,
                    'primer_apellido' =>$persona->ap_paterno,
                    'segundo_apellido' =>$persona->ap_materno,
                    'sexo' =>$persona->sexo,
                    'telefono' => $persona->telefono,
                    'tipo_documento' => 1,
                    'tipo_persona' => 1,
                    ];
            }else
            {
                $juridica = RrhhPersonaJuridica::where('id',$valor->persona_juridica_id)->first();
                if (!$juridica == null) {
                    $sujeto []= [
                        'celular' => $juridica->celular,
                        'codigo_fud' =>$caso->Caso,
                        'codigo_municipio_residencia' =>$juridica->municipio_id_residencia,
                        'codigo_sujeto_procesal' =>$valor->id,
                        'codigo_tipo_sujeto' => $juridica->tipo_sujeto_id,
                        'complemento' => '',
                        'correo_electronico' => $juridica->email,
                        'domicilio' => $juridica->domicilio,
                        'es_ciudadano_digital' => $juridica->es_ciudadano_digital,
                        'fecha_nacimiento' => $juridica->f_nacimiento,
                        'genero' => $juridica->genero,
                        'nombre_sujeto_procesal' => $valor->busqueda_nombre,
                        'nombres' => $juridica->nombre,
                        'numero_documento' => $juridica->n_documento,
                        'primer_apellido' =>$juridica->ap_paterno,
                        'segundo_apellido' =>$juridica->ap_materno,
                        'sexo' =>$juridica->sexo,
                        'telefono' => $juridica->telefono,
                        'tipo_documento' => 1,
                        'tipo_persona' => 1,
                        ];
                }else
                {
                    $desconocida = RrhhPersonaDesconocida::where('id',$valor->persona_desconocida_id)->first();
                    if (!$juridica == null) {
                        $sujeto []= [
                                'celular' => $desconocida->celular,
                                'codigo_fud' =>$caso->Caso,
                                'codigo_municipio_residencia' =>$desconocida->municipio_id_residencia,
                                'codigo_sujeto_procesal' =>$valor->id,
                                'codigo_tipo_sujeto' => $desconocida->tipo_sujeto_id,
                                'complemento' => '',
                                'correo_electronico' => $desconocida->email,
                                'domicilio' => $desconocida->domicilio,
                                'es_ciudadano_digital' => $desconocida->es_ciudadano_digital,
                                'fecha_nacimiento' => $desconocida->f_nacimiento,
                                'genero' => $desconocida->genero,
                                'nombre_sujeto_procesal' => $valor->busqueda_nombre,
                                'nombres' => $desconocida->nombre,
                                'numero_documento' => $desconocida->n_documento,
                                'primer_apellido' =>$desconocida->ap_paterno,
                                'segundo_apellido' =>$desconocida->ap_materno,
                                'sexo' =>$desconocida->sexo,
                                'telefono' => $desconocida->telefono,
                                'tipo_documento' => 1,
                                'tipo_persona' => 1,
                                ];
                    }else
                    {
                        return false;
                    }
                }
            }

            $medidaProtec = PersonaMedidasProteccion::where('hechopersona_id',$valor->id)->get();
            foreach ($medidaProtec as $key => $value) {
                $medidas = [
                    'codigo_fud' => $caso->Caso,
                    'codigo_medida_proteccion' => $value->medidaproteccion_id,
                    'codigo_sujeto_procesal' => $valor->tipo_sujeto_id,
                ]
            }
        }*/
    }

        
}
