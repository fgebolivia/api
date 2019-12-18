<?php

namespace App\Http\Controllers\Busquedas;

use App\Http\Controllers\Controller;
use App\Models\Denuncia\Hecho;
use Illuminate\Http\Request;

class BusquedaCasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigo_cud = isset($_GET['codigo_cud'])?$_GET['codigo_cud']: null;
        $fecha_del  = isset($_GET['fecha_del'])?$_GET['fecha_del']: null;
        $fecha_al   = isset($_GET['fecha_al'])?$_GET['fecha_al']: null;
        $persona_ci = isset($_GET['persona_ci'])?$_GET['persona_ci']: null;
        $nombre     = isset($_GET['nombre'])?$_GET['nombre']: null;

        if (!$codigo_cud)
        {
            if (!$persona_ci)
            {
                if (!$nombre)
                {
                    if (!$fecha_del || !$fecha_al)
                    {
                        return $this->errorResponse('no existe parametros validos',422);
                    }else
                    {

                    }
                }else
                {

                }
            }else
            {

            }
        }else
        {
            $hecho = Hecho::where('codigo','like','%'.$codigo_cud.'%')->select('id','codigo','fecha_creacion_denuncia','hecho_estado_id','hecho_etapa_id')->get();
            return $this->showAll($hecho,200);
        }
        return $codigo_cud.'-'.$persona_ci.'-'.$nombre.'-'.$fecha_del.'-'.$fecha_al;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
