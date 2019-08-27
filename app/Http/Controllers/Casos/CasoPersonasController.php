<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Models\Denuncias\Hecho;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

class CasoPersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function index(Hecho $hecho)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function create(Hecho $hecho)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Hecho $hecho)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @param  \App\Models\Rrhh\RrhhPersona  $rrhhPersona
     * @return \Illuminate\Http\Response
     */
    public function show(Hecho $hecho, RrhhPersona $rrhhPersona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @param  \App\Models\Rrhh\RrhhPersona  $rrhhPersona
     * @return \Illuminate\Http\Response
     */
    public function edit(Hecho $hecho, RrhhPersona $rrhhPersona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @param  \App\Models\Rrhh\RrhhPersona  $rrhhPersona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hecho $hecho, RrhhPersona $rrhhPersona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Denuncias\Hecho  $hecho
     * @param  \App\Models\Rrhh\RrhhPersona  $rrhhPersona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hecho $hecho, RrhhPersona $rrhhPersona)
    {
        //
    }
}
