<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CasoResource;
use App\Models\Denuncia\Hecho;
use Illuminate\Http\Request;

class CasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hechos = Hecho::all();
        //return CasoResource::collection($hechos);
        return $this->showAll($hechos);
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
            'codigo' => 'required|max:20',
            'relato' => 'required',
            'conducta'=> 'required',
            'resultado' => 'required',
            'circunstancia' => 'required',
            'direccion' => 'required',
            'zona' => 'required',
            'detallelocacion' => 'required',
            'municipio_id' => 'required',
            'created_at' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'tipo_denuncia_id' => 'required',
            'fechahorainicio' => 'required',
            'fechahorafin' => 'required',
            'aproximado' => 'required'
            ]);

        //Hecho::create($data);

        return $this->successMesagesResponse('se inserto satisfactoriamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hecho = Hecho::where('codigo', $id)->select('codigo','relato','conducta','resultado','circunstancia','direccion','zona','detallelocacion','municipio_id','created_at','longitude','latitude','tipo_denuncia_id','fechahorainicio','fechahorafin','aproximado','titulo')->first();
        return $this->showOne($hecho);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hecho $hecho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hecho $hecho)
    {
        //
    }
}
