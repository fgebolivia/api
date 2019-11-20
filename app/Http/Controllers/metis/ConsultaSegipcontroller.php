<?php

namespace App\Http\Controllers\metis;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertificacionPersonaComplementoResource;
use App\Http\Resources\CertificacionPersonaResource;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

class ConsultaSegipcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            ]);
        $persona = RrhhPersona::where('n_documento',$id)->get();
        //dd($persona->isEmpty());
        if ($persona->isEmpty())
        {
            if ($request->complemento == '')
            {
                return $request->nombre;
            }
            else
            {
                $persona = RrhhPersona::where('n_documento',$id.'-'.$request->complemento)->get();
                $perosonaTransform = CertificacionPersonaComplementoResource::collection($persona);
            }
        }
        else
        {
            $persona = RrhhPersona::where('n_documento',$id)->get();
            $perosonaTransform = CertificacionPersonaResource::collection($persona);
        };

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

}
