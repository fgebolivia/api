<?php

namespace App\Http\Controllers\Helper;

use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\Models\UbicacionGeografica\UbgePais;
use GuzzleHttp\Client;

class HelperPoliciaSujetosProcesales
{
    public static function insertDenunciante($idSujeto)
    {
        $sujeto = HechoPersona::where('id',$idSujeto)->first();

        $caso = Hecho::where('id',$sujeto->hecho_id)->first();

        $headers = ['Content-Type' => 'application/json'];
        if ($Sujeto->tipo_sujeto_id == 1) {
            $data = RrhhPersona::where('id',$sujeto->persona_id)->first();
            $nacionalidadPersona = UbgePais::where('id'$data->pais_id)->first();
            $naturalde =UbgeMunicipio::where('id',$sujeto->municipio_id_nacimiento)->first();

            $queryParams = [
                'id_denunciante' => $data->id,
                'numcaso' => $caso->codigo,
                'tipo' => $caso->tipo_denuncia_id,
                'documento' => 'ci',
                'numdoc' => $data->n_documento,
                'complemento' => '',
                'paterno' => $data->ap_paterno,
                'materno' => $data->ap_materno,
                'casada' => $data->ap_esposo,
                'nombres' => $data->nombre,
                'fnacimiento' => $data->f_nacimiento,
                'razon' => '',
                'nit' => '',
                'domlegal' => $data->domicilio,
                'fonocentral' => $data->telefono,
                'genero' => $data->genero,
                'sexo' => $data->sexo,
                'nacionalidad' => $nacionalidadPersona->nombre,
                'naturalde' => $naturalde->nombre,
                'ecivil' => $data->estado_civil,
                'profesion' => $data->profesion_ocupacion,
                'relacion' => $sujeto->codigo,
                'grupo' => $data->grupo_vulnerable_id,
                'laboral' => $data->telf_laboral,
                'celular' => $data->celular,
                'mail' => $data->email,
                'latitud' => $data->map_latitud,
                'longitud' =>$data->map_longitud,
                'referencia' =>'',
                'direccion' =>'',
            ];
        }

            $deco = json_encode($queryParams);
            //dd($deco);
            $client = new Client();

            $response = $client->post('http://api.fudv2.policia.bo/denunciante',[
                'headers' => $headers,
                'body' => $deco
            ]);
        return $response->getBody()->getContents();
    } 
}
