<?php

namespace App\Http\Controllers\Actividades;

use App\Helpers\HelperJuzgado;
use App\Http\Controllers\Controller;
use App\Models\Agenda\Juzgado;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoJuzgado;
use Illuminate\Http\Request;

class HechoJuzgadoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo_fud' => 'required|string|max:30',
            'codigo_juzgado_baja' => 'required|integer',
            'fecha_juzgado_baja' => 'required|date',
            'motivo_baja' => 'required|string|max:250',
            'codigo_juzgado_nuevo' => 'required|integer',
            'fecha_juzgado_alta' => 'required|date',
            ]);
        //=== CONSULTA HECHO ===
            $hecho = Hecho::where('codigo',$request->codigo_fud)->first();
            if (!$hecho) {
                return $this->errorResponse('El codigo FUD no Existe',422);
            }

        //=== CONSULTA JUZGADO ALTA ===
            $juzgado = Juzgado::where('codigo_juzgado',$request->codigo_juzgado_nuevo)->first();
            if (!$juzgado) {
                $juzgadoinsert = new HelperJuzgado();
                $respuesta = $juzgadoinsert->GetJuzgado($request->codigo_juzgado_nuevo);
                $juzgado_id = $respuesta;
            }
            else
            {
                $juzgado_id =$juzgado->id;
            }

            $juzgadoBaja = Juzgado::where('codigo_juzgado',$request->codigo_juzgado_baja)->first();

            if (!$juzgadoBaja) {
                return $this->errorResponse('El codigo Juzgado para dar de baja no Existe',422);
            }
        //=== CONSULTA JUZGADO BAJA ===
            $jusgadoBaja = HechoJuzgado::where('juzgado_id',$juzgadoBaja->id)->where('hecho_id',$hecho->id)->first();
            if (!$jusgadoBaja) {
                return $this->errorResponse('El codigo Juzgado hacer dado de baja no Existe',422);
            }
            else
            {
                $jusgadoBaja->fecha_baja = $request->fecha_juzgado_baja;
                $jusgadoBaja->motivo = $request->motivo_baja;
                $jusgadoBaja->estado = 0;
                $jusgadoBaja->save();
            }
        //=== INSERTAR NUEVO JUZGADO DEL ECHO ==
            $hecho->jusgado_id = $juzgado_id;
            $hecho->save();

            $juzgadoHecho             = new HechoJuzgado();
            $juzgadoHecho->hecho_id   = $hecho->id;
            $juzgadoHecho->juzgado_id = $juzgado_id;
            $juzgadoHecho->motivo     = 'Cambio de Juzgado del caso en el Organo Judicial';
            $juzgadoHecho->fecha_alta = date('Y-m-d H:i:s');
            $juzgadoHecho->save();

        return $this->successConection('Se actualizo el juzgado del caso corectamente',201);
    }

}
