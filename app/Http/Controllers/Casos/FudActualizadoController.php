<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Models\Denuncia\Hecho;
use Illuminate\Http\Request;

class FudActualizadoController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hecho = Hecho::where('codigo',$id)->first();
        if (!$hecho) {
            return $this->errorResponse('El codigo del Caso no existe',400);
        }

        $file  = 'https://triton.fiscalia.gob.bo/hechocontroller/imprimirfudextendido2/'.$hecho->id;

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $source = file_get_contents($file,false, stream_context_create($arrContextOptions));
        $deco = base64_encode($source);


        return response()->json(['code' => 200,'archivo_actualizado'=> $deco],200);

    }
}
