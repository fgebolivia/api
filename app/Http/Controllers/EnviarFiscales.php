<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnviarFiscales extends Controller
{
	public function POST($data){
    $caso =[
            'codigoAudiencia' => '14',
            'fiscales' => [
	            	[
	                'ci'=> $data->n_documento,
	                'complemento'=>'',
	                'nombres'=>$data->n_documento,  
	                'primerApellido'=> $data->ap_paterno,
	                'segundoApellido'=>$data->ap_materno,
	                'fechaNacimiento'=>$data->f_nacimiento
	            	],
            	],
            ];

            $deco = json_encode($caso);

        $client = new Client();
        $response = $client->post('http://wseforo.organojudicial.gob.bo/api/audiencia/fiscales',[
            'headers' => ['Content-Type' => 'application/json','Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImZpc2NhbGlhIiwibmFtZWlkIjoiNyIsImlkWm9uYSI6IjAiLCJyb2xlIjoiV3NGaXNjYWxpYSIsIm5iZiI6MTU3MDIwNDY2MiwiZXhwIjoxNzI3ODg0NjYyLCJpYXQiOjE1NzAyMDQ2NjIsImlzcyI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyIsImF1ZCI6Imh0dHA6Ly93c2Vmb3JvLnBqLXNjci5wb2Rlcmp1ZGljaWFsLmdvdi5ibyJ9.J_fzQ2I4YQ3jwmWHpt0df5Uc07eS0wqHPPr2zEQaHcM'],
            'body' => $deco
        ]);

        $products = $response->getBody()->getContents();
    }
}
