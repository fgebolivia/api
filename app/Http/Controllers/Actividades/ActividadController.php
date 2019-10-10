<?php

namespace App\Http\Controllers\Actividades;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActividadResource;
//use App\Http\Resources\DelitoResource;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoFelony;
use App\Models\Notificacion\Caso;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
  
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$hecho = Hecho::where('codigo',$id)->first();
        //return $this->ShowOne($delito,200);
        if ($hecho == null) {
            return $this->errorResponse('Does not exists any endpoint for this URL',404);
        }else{
            //dd($hecho->id);
            $hechos1 = new DelitoResource($hecho);
            //dd($hechos1);
            return $hechos1;
        }*/
        $caso = Caso::where('Caso', $id)->first();
        if ($caso == null) {
            return $this->errorResponse('Does not exists any endpoint for this URL',404);
        }else{
            //dd($caso->id);
            $hechos1 = new ActividadResource($caso);
            //dd($hechos1);
            return $hechos1;
        }
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
