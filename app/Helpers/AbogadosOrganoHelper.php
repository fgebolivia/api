<?php
namespace App\Helpers;

use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\Sujeto;
use App\Models\I4\SigcAbogado;
use App\Models\I4\SigcHechoSujetoAbogado;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;


class AbogadosOrganoHelper {

	public static function postAbogado($hecho_id)
	{
		// === INICIALIZACION DE VARIABLES ===
            $respuesta = array(
                'sw'            => false,
                'mensaje'       => '',
                'api_respuesta' => ''
            );
        // === CONSULTAS ====
            //=== cCONSULTA HECHO ===
            	$hecho =  Hecho::where('id',$hecho_id)->first();
            	if (!$hecho) {
            		$respuesta['mensaje'] = 'el Hecho no exite';
					return $respuesta;
            	}

            //=== CONSULTA PERSONA TRITON ===
            	$personaTriton = Sujeto::where('hecho_id',$hecho_id)->get();
            	//dd($personaTriton);
            	if ($personaTriton->isEmpty())
				{
					$respuesta['mensaje'] = 'el id de la persona no exite';
					return $respuesta;
				}

				$queryParams  = array();
				$arrayAbogado = array();
				$natural = false;
				foreach ($personaTriton as $key => $value)
				{
					//=== CONSULTA ABOGADOS DE PERSONA ===
					if ($value->persona_id == null) {
						if ($value->persona_juridica_id == null) {
							if ($value->persona_desconocida_id == null) {
								$respuesta['mensaje'] = 'La calse de persona esta equivocada no exite';
								return $respuesta;
							}
							else
							{
								$natural = true;
							}
						}
						else
						{
							$natural = false;
						}
					}
					else
					{
						$natural = true;
					}
					$arrayAbogado =self::setAbogado($value->i4_persona_id);
					$queryParams[] = [
								'idPersona' => $value->id,
		                        'esNatural' => $natural,
		                        'Abogados'  => $arrayAbogado,
							];

				}
				return $queryParams;
                try
                {

                    $deco = json_encode($queryParams);
                    $client = new Client();

                    $headers = ['Content-Type' => 'application/json;charset=UTF-8',
                                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                    ];
                    $response = $client->post('http://wseforo.organojudicial.gob.bo/api/abogados/'.$hecho->codigo,[
                        'headers' => $headers,
                        'body'    => $deco
                    ]);

                    $res = $response->getBody()->getContents();
                    // \Log::warning($res);
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
                }
                catch (ClientException $e)
                {
                    // dd(json_decode($e->getResponse()->getBody()->getContents(), TRUE));
                    $respuesta['api_respuesta']= json_decode($e->getResponse()->getBody()->getContents());
                    $respuesta['mensaje']      = 'Error en la respuesta del servicio.';
                }
            // \Log::warning($respuesta);
            return $respuesta;
	}

	public static function setAbogado($id)
	{
		$abogados = SigcHechoSujetoAbogado::where('hecho_sujeto_id',$id)
									->where('estado',1)
									->get();
		$abog = array();
		$estado= false;
		foreach ($abogados as $key)
		{
			if ($key->estado === 1) {
				$estado = true;
			}
			else
			{
				$esta = false;
			}
			$abogado = SigcAbogado::where('id',$key->abogado_id)->first();
			$abog[] =[
					'ci'              => $abogado->n_documento,
					'nombres'         => $abogado->nombre,
					'primerApellido'  => $abogado->ap_paterno,
					'segundoApellido' => $abogado->ap_materno,
					'fechaNacimiento' => $abogado->f_nacimiento,
					'matricula'		  => $abogado->matricula,
					'estado' 		  => $estado,
					'fechaHoraAlta'   => $key->fh_alta,
					'fechaHoraBaja'   => $key->fh_baja
	            ];
		}
		return $abog;
	}
}//fin clase