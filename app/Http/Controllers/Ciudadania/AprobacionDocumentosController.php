<?php

namespace App\Http\Controllers\Ciudadania;

use App\Http\Controllers\Controller;
use App\Models\Notificacion\DocumentosAprobados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'requestUuid' => 'required|max:250|string',
            'codigoOperacion' => 'max:250',//este
            'mensaje' => 'max:250|string',
            'transaction_id' => 'max:250',//este
            'fechaHoraSolicitud' => 'max:250|string',//este
            'hashDatos' => 'max:250|string',
            'ci' => 'max:250|string',
            ]);
        $tramiteUuid = DocumentosAprobados::where('tramite_uuid',$request->requestUuid)->first();
        if ($tramiteUuid === null) {
                    return response()->json(['finalizado'=>false, 'message'=> 'el campo requestUuid no exite', 'code' => 422],422);
                }
        if ($request->aceptado) {
            $tramiteUuid->codigo_operacion = $request->codigoOperacion;
            $tramiteUuid->transaccion_id = $request->transaction_id;
            $tramiteUuid->fh_solicitud_agetic = date('Y-m-d H:i:s', strtotime(str_replace('/', '-',$request->fechaHoraSolicitud)));
            $tramiteUuid->tramite_uuid = $request->requestUuid;
            $tramiteUuid->save();

            $sql ="UPDATE " . $tramiteUuid->tabla . " 
            SET 
            aprobado_cd = 1
            WHERE id = " . $tramiteUuid->tabla_id;
            if($tramiteUuid->tipo_conexion === 0){
                DB::statement($sql);
            }
            else{
                DB::connection('comments')->statement($sql);
            }
            
        }else{
            
            $tramiteUuid->fh_solicitud_agetic = date('Y-m-d H:i:s', strtotime(str_replace('/', '-',$request->fechaHoraSolicitud)));
            $tramiteUuid->save();
            return response()->json(['finalizado'=>true, 'message'=> 'Los valores del rechazo fueron registradas en el Sistema Cliente.', 'code' => 200],200);
        }

        return response()->json(['finalizado'=>true, 'message'=> 'Los valores de aprobación fueron registradas en el Sistema Cliente.', 'code' => 200],200);
    }
}
