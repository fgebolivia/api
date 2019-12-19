<?php

namespace App\Http\Controllers\Migraciones;

use App\Http\Controllers\Controller;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\HistoricoEstadoLibertad;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

class EstadoProcesalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $n_documento = isset($_GET['ci'])?$_GET['ci']: 5;
        $hechoSujeto = HechoPersona::where('busqueda_ci',$n_documento)->where('tipo_sujeto_id',2)->where('deleted',0)->select('id','busqueda_nombre','hecho_id','persona_id','persona_juridica_id','persona_desconocida_id')->orderBy('hecho_id','asc')->get();
        $araigo = array();
        foreach ($hechoSujeto as $key => $value)
        {
            $estadoLibertad = HistoricoEstadoLibertad::where('hecho_persona_id',$value->id)->where('estado_libertad_id',3)->first();

            if ($estadoLibertad)
            {
                $persona = RrhhPersona::where('id',$value->persona_id)->select()->first();
                $hecho = Hecho::where('id',$value->hecho_id)->select('codigo','municipio_id')->first();
                $araigo[] = [
                    'n_documento'           => $persona->n_documento,
                    'tipo_documento'        => $persona->tipo_documento_id,
                    'nombre'                => $persona->nombre,
                    'primer_apellido'       => $persona->ap_paterno,
                    'segundo_apellido'      => $persona->ap_materno,
                    'fecha_nacimiento'      => $persona->f_nacimiento,
                    'estado_procesal'       => $estadoLibertad->estado_libertad_id,
                    'fecha_estado_procesal' => $estadoLibertad->fecha_hora,
                    'codigo_caso'           => $hecho->codigo,
                    'ubicacion_caso'        => $hecho->municipio_id,
                    'url_documento'         => 'https://triton-dev.fiscalia.gob.bo'
                ];
            }
        }
        return $araigo;

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
