<?php

namespace App\Helpers;

use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\HistoricoEstadoLibertad;
use App\Models\Denuncia\PolOficina;
use App\Models\Rrhh\RrhhPersona;
use App\Models\Rrhh\RrhhPersonaDesconocida;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\Models\UbicacionGeografica\UbgeProvincia;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class HelperRejaf
{
  public static function GetRejaf($ciPersona, $codigoFud)
  {
      // === INICIALIZACION DE VARIABLES ===
            $respuesta = array(
                'sw'            => false,
                'mensaje'       => '',
                'api_respuesta' => ''
            );

      //=== CONSULTA HECHO ===
       	$fud = Hecho::where('codigo',$codigoFud)->first();
        if (!$fud)
        {
          $respuesta['mensaje'] = 'El hecho no exite';
          \Log::warning('CONSULTA HECHO AL TRITON: El hecho no existe.');
          return $respuesta;
        }

      //=== CONSULTA PERSONA ===
       	$personaRejaf = RrhhPersona::where('n_documento',$ciPersona)->first();
        if (!$personaRejaf)
        {

          \Log::warning('CONSULTA PERSONA AL TRITON: La persona no existe.');
          $personaRejaf = RrhhPersonaDesconocida::where('n_documento',$ciPersona)->first();
          //dd($personaRejaf);
            if ($personaRejaf->n_documento === null || $personaRejaf->nombre     === null ||
                $personaRejaf->ap_paterno  === null || $personaRejaf->ap_materno === null   )
            {
              $respuesta['mensaje']= 'La persona desconocida no exite';
              \Log::warning('CONSULTA PERSONA DESCONOCIDA AL TRITON: La persona desconocida no existe.');
              return $respuesta;
            }
        }

      //=== CONSULTA SOLICITANTE  USER REJAP ===
        $userPersonaId   = User::where('id',$fud->user_id)->first();
        if (!$userPersonaId)
        {
            $respuesta['mensaje']= 'El Usuario no exite';
            $respuesta['sw']     = false;
            \Log::warning('CONSULTA USER AL TRITON: El USER no existe.');
            return $respuesta;
        }

      //=== CONSULTA SOLICITANTE PERSONA REJAP ===
        $solicitanteRejaf= RrhhPersona::where('id',$userPersonaId->persona_id)->first();
        if (!$solicitanteRejaf)
        {
          $respuesta['mensaje']= 'La persona no exite';
          $respuesta['sw']     = false;
          \Log::warning('CONSULTA PERSONA AL TRITON: La persona no existe.');
          return $respuesta;
        }

      //=== CONSULTA SOLICITANTE OFICINA REJAP ===
        $oficinaMunicipio= PolOficina::where('id',$fud->oficina_id)->first();
        if (!$oficinaMunicipio)
        {
          $respuesta['mensaje']= 'La oficina no exite';
          $respuesta['sw']     = false;
          \Log::warning('CONSULTA OFICINA AL TRITON: La oficina no existe.');
          return $respuesta;
        }

      //=== CONSULTA SOLICITANTE MUNICIPIO REJAP ===
        $numicipio= UbgeMunicipio::where('id',$oficinaMunicipio->municipio_id)->first();
        if (!$numicipio)
        {
          $respuesta['mensaje']= 'El municipio no exite';
          $respuesta['sw']     = false;
          \Log::warning('CONSULTA MUNICIPIO AL TRITON: El municipio no existe.');
          return $respuesta;
        }

      //=== CONSULTA SOLICITANTE PROVINCIA REJAP ===
        $provincia= UbgeProvincia::where('id',$numicipio->provincia_id)->first();
        if (!$provincia)
        {
          $respuesta['mensaje']= 'El provincia no exite';
          $respuesta['sw']     = false;
          \Log::warning('CONSULTA PROVINCIA AL TRITON: El provincia no existe.');
          return $respuesta;
        }

      //=== CONSULTA HECHO PERSONA REJAP ===
        $insertarRejap = HechoPersona::where('persona_id',$personaRejaf->id)->where('hecho_id',$fud->id)->first();

         if (!$insertarRejap)
        {
          $insertarRejap = HechoPersona::where('persona_desconocida_id',$personaRejaf->id)->first();
          //dd($insertarRejap);
          $estadoLibertad = HistoricoEstadoLibertad::where('hecho_persona_id', $insertarRejap->id)/*->orderBy('fecha_hora','desc')*/->first();
          dd($estadoLibertad);
        }
        else
        {
          $estadoLibertad = HistoricoEstadoLibertad::where('hecho_persona_id', $insertarRejap->id)->orderBy('fecha_hora','desc')->first();
        }


      //=== ARMADO JSON REJAP ===

        $queryParams = [
            'tipoDocId'         => '1',
            'docId'             => $personaRejaf->n_documento,
            'nombres'           => $personaRejaf->nombre,
            'primerApellido'    => $personaRejaf->ap_paterno,
            'segundoApellido'   => $personaRejaf->ap_materno,
            'dcasada'           => $personaRejaf->ap_esposo,
            'fechaNacimiento'   => date('d/m/Y', strtotime($personaRejaf->f_nacimiento)),//date('Y-m-d H:i:s'),
            'detalleMotivo'     => 'Caso '.$codigoFud,
            'nombreSolicitante' => $solicitanteRejaf->nombre.' '.$solicitanteRejaf->ap_paterno.' '.$solicitanteRejaf->ap_materno ,
            'domicilio'         => $oficinaMunicipio->nombre,
            'codigoDepartamento'=> $provincia->codigo_interoperar_dep,
            'codigoProvincia'   => $provincia->codigo_interoperar,
            'codigoUsuario'     => 'F'.$solicitanteRejaf->n_documento,
            'idEstadoLibertad'  => $estadoLibertad->estado_libertad_id,
        ];
        return $queryParams;
        $deco = json_encode($queryParams);

      //=== HEADER POST REJAP ===
        $headers = [
            'Content-Type' => 'application/json',
            'Cache-Control'=> 'no-cache',
            'Authorization'=> 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJqdGkiOiJzb2Z0dGVrSldUIiwic3ViIjoiamJlcmdtYW4iLCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwiaWF0IjoxNTcyMDUzNzE5LCJleHAiOjE1NzIxNDAxMTl9.LuHeaiDHXxcHR9buA_1m-BkT7g4tWlt-WuEgDdYP4claONZVS3KbLCMSwumLiL7ddK9v84fa9asAPpg4ckT_7w',

        ];

      try
      {
        //=== ENVIO POST REJAP ===
          $client = new Client();

            $response = $client->post('magistratura.organojudicial.gob.bo:8888/rejap/v1/solicitudes',[
                'headers' => $headers,
                'body' => $deco
            ]);

        //=== RESPUESTA POST REJAP ===
          $respuesta_api = $response->getBody()->getContents();


          $respuestaRejap = json_decode($respuesta_api);

        //=== ARCHIVO EN FICHERO ===
          if ($respuestaRejap->certificado != '')
          {
            $file_name = uniqid('certificado_rejap', true) . ".pdf";
            $file      = public_path('/storage/rejap/archivo') . "/" . $file_name;
            file_put_contents($file,base64_decode($respuestaRejap->certificado));
          }else
          {
            $file_name = null;
            \Log::warning('TRITON HECHO PERSONA: se guardo el nombre del archivo con valor null');
          }

        //=== INSERTAR REJAP EN HECHO PERSONA ===
            $insertarRejap->rejap_codigo_solicitud= $respuestaRejap->solicitud;
            $insertarRejap->rejap_estado          = $respuestaRejap->estado;
            $insertarRejap->rejap_fecha_peticion  = date('Y-m-d H:i:s');
            $insertarRejap->rejap_fecha_recepcion = $respuestaRejap->fecha;
            $insertarRejap->rejap_archivo         = $file_name;
            $insertarRejap->save();
            $respuesta['mensaje']                 = 'se guardo el REJAP';
            $respuesta['api_respuesta']           = $respuestaRejap->mensaje;
            $respuesta['sw']                      = true;
            return $respuesta;
          \Log::warning($respuesta);
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

}
