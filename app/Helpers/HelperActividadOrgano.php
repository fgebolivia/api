<?php

namespace App\Helpers;

use App\Models\Denuncia\Hecho;
use App\Models\Notificacion\Actividad;
use App\Models\Notificacion\TipoActividad;
use GuzzleHttp\Client;


class HelperActividadOrgano
{
   public static function PostActividad($codigo_fud, $idActividad){

    $hecho = Hecho::where('codigo',$codigo_fud)->first();

    $actividad = Actividad::where('id',$idActividad)->where('Caso',$hecho->i4_caso_id)->first();
    $tipoValido = TipoActividad::where('id',$actividad->TipoActividad)->first();

    if ($tipoValido->Interoperabilidad === 0) {
        return 0;
    }

    $file_name = 'Prueba.pdf';
    $file      = public_path('/storage/agenda'). "/" . $file_name;
    $b64Doc = chunk_split(base64_encode(file_get_contents($file)));

   	$headers = ['Content-Type' => 'application/json',
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                ];

    $queryParams = [
                'idTipoActividad' => $actividad->TipoActividad,
                'codigo' => $idActividad,
                'fecha' => $actividad->Fecha,
                'descripcion' => $actividad->Actividad,
                'archivo' => $b64Doc,
                //'archivo' => chunk_split(base64_encode($actividad->Documento)),
            ];
    //return $queryParams;
    $deco = json_encode($queryParams);

        $client = new Client();

        $response = $client->post('http://wseforo.organojudicial.gob.bo/api/actividades/'.$codigo_fud,[
            'headers' => $headers,
            'body' => $deco
        ]);
    return $response->getBody()->getContents();
    
   }
}
