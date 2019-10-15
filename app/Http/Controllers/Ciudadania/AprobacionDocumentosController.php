<?php

namespace App\Http\Controllers\Ciudadania;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
* @group Metodos de Arpobacionde Documentos AGETIC.
*
*/

class AprobacionDocumentosController extends Controller
{

    public function __construct()
    {
        $this->middleware('scope:aprovacion_documento')->only('store');//decomentar cunado ya este validado todo el post
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'aceptado' => 'required|boolean',
            'introducido' => 'required|boolean',
            'uuidTramite' => 'required|max:250|string',
            'codigoOperacion' => 'required|max:250|string',
            'mensaje' => 'required|max:250|string',
            'transaction_id' => 'required|max:250|string',
            'fechaHoraSolicitud' => 'required|max:250|string',
            'hashDatos' => 'required|max:250|string',
            'ci' => 'required|max:250|string',
            ]);
        
        
        return response()->json(['finalizado'=>true, 'message'=> 'se lleno correctamente', 'code' => 200],200);
    }
}
