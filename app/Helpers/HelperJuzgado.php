<?php

namespace App\Helpers;

use App\Models\Agenda\Juzgado;
use GuzzleHttp\Client;

class HelperJuzgado
{
   
   public static function GetJuzgado($juzgado_id)
   {

        $client = new Client();

        $headers = ['Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'
                ];

        $response = $client->get('http://wseforo.organojudicial.gob.bo/api/oficina/juzgado/'.$juzgado_id,[
            'headers' => $headers,
        ]);

        $respuesta = $response->getBody()->getContents();

        $insertJuzgado = json_decode($respuesta);

          $muni = UbgeMunicipio::where('codigo',$insertJuzgado->juzgado->codigoMunicipio)->first();

            $juzgadoInsert = new Juzgado();

            $juzgadoInsert->codigo_juzgado = $insertJuzgado->juzgado->id;
            $juzgadoInsert->nombre = $insertJuzgado->juzgado->nombre;
            $juzgadoInsert->municipio_id = $muni->id;
            $juzgadoInsert->oficina_gestora = $insertJuzgado->juzgado->oficinaGestora;
            $juzgadoInsert->zona = $insertJuzgado->juzgado->zona;
            $juzgadoInsert->direccion = $insertJuzgado->juzgado->direccion;
            $juzgadoInsert->map_latitud = $insertJuzgado->juzgado->latitud;
            $juzgadoInsert->map_longitud = $insertJuzgado->juzgado->longitud;
            $juzgadoInsert->edificio= $insertJuzgado->juzgado->edificio;
            $juzgadoInsert->telefono = $insertJuzgado->juzgado->telefonos;
            $juzgadoInsert->save();

        return $juzgadoInsert->id;
   }
}
