<?php

namespace App\Http\Controllers\Ciudadania;

use App\Http\Controllers\Controller;
use App\Models\Notificacion\DocumentosAprobados;
use Illuminate\Http\Request;

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
            'codigoOperacion' => 'max:250|string',//este
            'mensaje' => 'max:250|string',
            'transaction_id' => 'max:250|string',//este
            'fechaHoraSolicitud' => 'max:250|string',//este
            'hashDatos' => 'max:250|string',
            'ci' => 'max:250|string',
            ]);
        if (!$request->aceptado) {
            return response()->json(['finalizado'=>false, 'message'=> 'el campo aceptado tiene el valor de false', 'code' => 422],422);
        }

        $tramiteUuid = DocumentosAprobados::where('tramite_uuid',$request->uuidTramite)->first();

        if ($tramiteUuid === null) {
                    return response()->json(['finalizado'=>false, 'message'=> 'el campo uuidTramite no exite', 'code' => 422],422);
                }

        
        $tramiteUuid->codigo_operacion = $request->codigoOperacion;
        $tramiteUuid->transaccion_id = $request->transaction_id;
        $tramiteUuid->fh_solicitud_agetic = date('Y-m-d H:i:s:u', strtotime($request->fechaHoraSolicitud));
        $tramiteUuid->tramite_uuid = $request->uuidTramite;
        $tramiteUuid->save();

        return response()->json(['finalizado'=>true, 'message'=> 'se lleno correctamente', 'code' => 200],200);
    }
}
