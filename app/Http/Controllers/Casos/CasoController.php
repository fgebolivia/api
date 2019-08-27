<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Models\Denuncias\Hecho;
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hecho = Hecho::where('codigo', $id)->first();
        return $this->showOne($hecho);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hecho $hecho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hecho $hecho)
    {
        //
    }
}
