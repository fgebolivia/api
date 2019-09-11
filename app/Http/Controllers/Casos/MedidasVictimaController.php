<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedidaProteccionResource;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Rrhh\RrhhPersona;
use Illuminate\Http\Request;

class MedidasVictimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hecho) 
    {
        $ci=  isset($_GET['ci'])?$_GET['ci']: 5;
        $reserva = Hecho::where('codigo',$hecho)->select('id','reserva')->first();

        //dd($reserva['id']);
        if ($ci == 5 || $reserva['id'] === null) {
            return $this->errorResponse('Escriba un CI valido o el caso '.$hecho.' no existe' ,200);
        }
        if ($reserva['reserva'] === 1) {
            return $this->errorResponse('El caso '.$hecho.' esta en reserva' ,200);
        }
        $persona_id = RrhhPersona::where('n_documento',$ci)->select('id')->first();

        $hechopersona = HechoPersona::where('hecho_id', $reserva['id'])->where('persona_id',$persona_id['id'])->where('tipo_sujeto_id',3)->first();

        if ($hechopersona == null) {
            return $this->errorResponse('la persona con CI: '.$ci.' no tiene medidas de proteccion' ,200);
        }

        $medidas = HechoPersona::where('id',$hechopersona->id)->first()->medidas()->Paginate(15);
        
        $medidasTransFormada = MedidaProteccionResource::collection($medidas);

        return $medidasTransFormada;
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
