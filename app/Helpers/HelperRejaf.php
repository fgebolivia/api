<?php

namespace App\Helpers;

use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\PolOficina;
use App\Models\Rrhh\RrhhPersona;
use App\Models\Rrhh\RrhhPersonaDesconocida;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\Models\UbicacionGeografica\UbgeProvincia;
use App\User;
use GuzzleHttp\Client;


class HelperRejaf
{
   public static function GetRejaf($ciPersona, $codigoFud){

     	$fud = Hecho::where('codigo',$codigoFud)->first();
     	
     	$personaRejaf = RrhhPersona::where('n_documento',$ciPersona)->first();
      if ($personaRejaf ) {

        $userPersonaId = User::where('id',$fud->user_id)->first();
        $solicitanteRejaf = RrhhPersona::where('id',$userPersonaId->persona_id)->first();
        $oficinaMunicipio = PolOficina::where('id',$fud->oficina_id)->first();
        $numicipio = UbgeMunicipio::where('id',$oficinaMunicipio->municipio_id)->first();
        
        $provincia = UbgeProvincia::where('id',$numicipio->provincia_id)->first();

        $headers = ['Content-Type' => 'application/json',
                    'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJqdGkiOiJzb2Z0dGVrSldUIiwic3ViIjoiamJlcmdtYW4iLCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwiaWF0IjoxNTcxNzU0NjQwLCJleHAiOjE1NzE4NDEwNDB9.VZfUkfoYbhP97wfsSgDR876E1cmVeVh4fCJHPHWTSqurnVaZZ8YWDIl7dGuVAyridxwoWWafJKuD3rxEMwA4Aw'
                    ];

        $queryParams = [
                    'tipoDocId' => '1',
                    'docId' => $personaRejaf->n_documento,
                    'nombres' => $personaRejaf->nombre,
                    'primerApellido' => $personaRejaf->ap_paterno,
                    'segundoApellido' => $personaRejaf->ap_materno,
                    'dcasada' => $personaRejaf->ap_esposo,
                    'fechaNacimiento' => date('d/m/Y', strtotime($personaRejaf->f_nacimiento)),//date('Y-m-d H:i:s'),
                    'detalleMotivo' => 'Caso '.$codigoFud,
                    'nombreSolicitante' => $solicitanteRejaf->nombre.' '.$solicitanteRejaf->ap_paterno.' '.$solicitanteRejaf->ap_materno ,
                    'domicilio' => $oficinaMunicipio->nombre,
                    'codigoDepartamento' => $provincia->codigo_interoperar_dep,
                    'codigoProvincia' => $provincia->codigo_interoperar,
                    'codigoUsuario' => 'F'.$solicitanteRejaf->n_documento,
                ];

      }else {
        $personaRejaf = RrhhPersonaDesconocida::where('n_documento',$ciPersona)->first();
        $userPersonaId = User::where('id',$fud->user_id)->first();
        $solicitanteRejaf = RrhhPersona::where('id',$userPersonaId->persona_id)->first();
        $oficinaMunicipio = PolOficina::where('id',$fud->oficina_id)->first();
        $numicipio = UbgeMunicipio::where('id',$oficinaMunicipio->municipio_id)->first();
        
        $provincia = UbgeProvincia::where('id',$numicipio->provincia_id)->first();

        $headers = ['Content-Type' => 'application/json',
                    'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJqdGkiOiJzb2Z0dGVrSldUIiwic3ViIjoiamJlcmdtYW4iLCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwiaWF0IjoxNTcxODYwNjg4LCJleHAiOjE1NzE5NDcwODh9._1RwRhcdlae_CufCXrV3sDgjSHJFf6CN8xsKf0P3N32nwJpzqtWvmBh-i3FPhIAaXNOo2TNKO9BEydA73qZ3bQ'
                    ];

        $queryParams = [
                    'tipoDocId' => '1',
                    'docId' => $personaRejaf->n_documento,
                    'nombres' => $personaRejaf->nombre,
                    'primerApellido' => $personaRejaf->ap_paterno,
                    'segundoApellido' => $personaRejaf->ap_materno,
                    'dcasada' => $personaRejaf->ap_esposo,
                    'fechaNacimiento' => date('d/m/Y', strtotime($personaRejaf->f_nacimiento)),//date('Y-m-d H:i:s'),
                    'detalleMotivo' => 'Caso '.$codigoFud,
                    'nombreSolicitante' => $solicitanteRejaf->nombre.' '.$solicitanteRejaf->ap_paterno.' '.$solicitanteRejaf->ap_materno ,
                    'domicilio' => $oficinaMunicipio->nombre,
                    'codigoDepartamento' => $provincia->codigo_interoperar_dep,
                    'codigoProvincia' => $provincia->codigo_interoperar,
                    'codigoUsuario' => 'F'.$solicitanteRejaf->n_documento,
                ];
      }
     	
      //dd($queryParams);
      return $queryParams;
      $deco = json_encode($queryParams);

              $client = new Client();

              $response = $client->post('magistratura.organojudicial.gob.bo:8888/rejap/v1/solicitudes',[
                  'headers' => $headers,
                  'body' => $deco
              ]);

      $respuesta = $response->getBody()->getContents();

      $respuestaRejap = json_decode($respuesta);

      $file_name = uniqid('certificado_rejap', true) . ".pdf";
      $file      = public_path('/storage/rejap/archivo') . "/" . $file_name;
      file_put_contents($file,base64_decode($respuestaRejap->certificado));
      
      $insertarRejap = HechoPersona::where('persona_id',$personaRejaf->id)->where('hecho_id',$fud->id)->first();
      $insertarRejap->rejap_codigo_solicitud = $respuestaRejap->solicitud;
      $insertarRejap->rejap_estado = $respuestaRejap->estado;
      $insertarRejap->rejap_fecha_peticion = date('Y-m-d H:i:s');
      $insertarRejap->rejap_fecha_recepcion = $respuestaRejap->fecha;
      $insertarRejap->rejap_archivo = $file_name;
      $insertarRejap->save();

      dd($insertarRejap);
   }
}
