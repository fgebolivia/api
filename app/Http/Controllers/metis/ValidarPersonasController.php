<?php

namespace App\Http\Controllers\metis;

use App\Http\Controllers\Controller;
use App\Models\Agenda\Agenda;
use App\Models\Agenda\AgendaPersona;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

class ValidarPersonasController extends Controller
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
    public function show($id)
    {
        $persona = RrhhPersona::where('n_documento',$id)->select('id','nombre','ap_paterno','ap_materno','f_nacimiento')->first();

        $gandamientoPersona = AgendaPersona::where('persona_id',$persona->id)->first();
        $agendamiento = Agenda::where('id',$gandamientoPersona->agenda_id)->first();
        return response()->json($agendamiento);
    }

}
