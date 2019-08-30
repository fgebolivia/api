<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\TipoSujeto;
use Illuminate\Http\Request;
//use Models\Rrhh\RrhhPersona;

class CasoPersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function index($hecho)
    {

        $tipo=  isset($_GET['tipo'])?$_GET['tipo']: 5;
        $tipoSujeto1 = TipoSujeto::where('id',intval($tipo))->select('id')->first();
        
        if ($tipoSujeto1['id'] != $tipo) {
            return $this->errorResponse('Does not exists any endpoint for this URL',422);
        }

        $personas = Hecho::where('codigo',$hecho)->first()->personas()->where('tipo_sujeto_id',$tipoSujeto1->id)->orderBy('id')->get();
        dd($personas);
        
        $personasJuridica = Hecho::where('codigo',$hecho)->first()->juridica()->where('tipo_sujeto_id',$tipoSujeto1->id)->orderBy('id')->get();

        $personasDesco = Hecho::where('codigo',$hecho)->first()->personaDesconocida()->where('tipo_sujeto_id',$tipoSujeto1->id)->orderBy('id')->get();

        if ($personas->isNotEmpty() && $personasJuridica->isNotEmpty() && $personasDesco->isNotEmpty()) {
            $sujetosx = $personas->merge($personasDesco);
            $sujetosProceales = $sujetosx->merge($personasJuridica);

            return $this->showAll($sujetosProceales);
        }else
        {   
            if($personas->isEmpty() && $personasJuridica->isEmpty() && $personasDesco->isEmpty()){

                return $this->errorResponse('Does not exists any endpoint for this URL',422);

            }elseif ($personas->isNotEmpty() && $personasJuridica->isNotEmpty() || $personasDesco->isEmpty()) {

                $sujetosProceales = $personas->merge($personasJuridica);
                return $this->showAll($sujetosProceales);

            }elseif ($personas->isNotEmpty() && $personasDesco->isNotEmpty() || $personasJuridica->isEmpty()) {

                $sujetosProceales = $personas->merge($personasDesco);
                return $this->showAll($sujetosProceales);

            }elseif ($personasJuridica->isNotEmpty() && $personasDesco->isNotEmpty() || $personas->isNotEmpty()) {

                $sujetosProceales = $personasJuridica->merge($personasDesco);
                return $this->showAll($sujetosProceales);
            }
        }
          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $hecho, $tipo)
    {
        $casovalidate = Hecho::where('codigo',$hecho)->first()->hechoPersonas()->get();
        if ($casovalidate->isNotEmpty()) {
            return $this->errorResponse('error el codigo ya se encuentra registrado',422);
        }
        //return Response()->json($casovalidate,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia\Hecho  $hecho
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
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @param  \App\Models\Rrhh\RrhhPersona  $rrhhPersona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hecho $hecho, RrhhPersona $rrhhPersona)
    {
        //
    }
}
