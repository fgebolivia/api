<?php

namespace App\Helpers;

use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\PersonaMedidasProteccion;
use App\Models\Notificacion\Caso;
use App\Models\Rrhh\RrhhPersona;
use App\Models\Rrhh\RrhhPersonaDesconocida;
use App\Models\Rrhh\RrhhPersonaJuridica;

//use GuzzleHttp\Client;

class HelperInicioOrganoJudicial
{
    public static function insertFormularioUnico($casoId, $arrayActividad)
    {
        $caso = Caso::where('id',$casoId)->first();

        foreach ($arrayActividad as $key) {
            $actividades[] =[
                    'codigo_actividad' => $key->codigo_actividad,
                    'codigo_fud' => $caso->Caso,
                    'codigo_tipo_actividad' => $key->codigo_tipo_actividad,
                    'descripcion' => $key->descripcion,
                    'fecha' => $key->fecha_actividad,
                    'archivo' => '',
                ];
        }

        foreach ($arrayDelito as $row) {
            $delito[] =[
                    'codigo_delito' => $row->codigo_delito,
                    'codigo_fud' => $caso->Caso,
                    'es_delito_principal' => $row->es_delito_principal,
                ];
        }

        $hechoPer = HechoPersona::where('hecho_id',$casoId)->get();
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
            

        }

        $headers = ['Content-Type' => 'application/json'];

         $queryParams = [
                'actividad' => $actividades,
                'codigo_delito_principal' => $caso->DelitoPrincipal,
                'codigo_estado_caso' => $caso->EstadoCaso,
                'codigo_etapa_caso' => $caso->EtapaCaso,
                'codigo_fud' => $caso->Caso,
                'codigo_municipio' => '1',
                'codigo_oficina' => '1',
                'delito' => $delito,
                'direccion_hecho' => 'lo que sea es la direccion',
                'fecha_denuncia' => '2019-10-17T10:22:30.275-04:00',
                'fecha_hecho' => '2019-10-17T10:22:30.275-04:00',
                'latitud' => '-13.87451478',
                'longitud' => '-69.1254877',
                'medida_de_proteccion' => $medidas,
                'referencia_hecho' => 'reofndskjbnldfb',
                'relato' => 'dkhfbgadknsglfdbndkfsb',
                'sujetos_procesales' => $sujeto,
                'tipo_denuncia' => 1,
                'zona_hecho' => 'calle no se que que es buena',
            ];

            return $deco = json_encode($queryParams);
            
            /*$client = new Client();

            $response = $client->post('http://magistratura.organojudicial.gob.bo:8888/wsInteroperabilidadSirej/servicios/formulariounico/v1',[
                'headers' => $headers,
                'body' => $deco
            ]);
        return $response->getBody()->getContents();*/
    } 
}
