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

        $file      = 'http://pruebas.local/hechocontroller/imprimirfudextendido2/'.$hecho->id;

        $deco = base64_encode(file_get_contents($file));

        return response()->json(['code' => 200,'archivo_actualizado'=> $deco],200);

    }
}
