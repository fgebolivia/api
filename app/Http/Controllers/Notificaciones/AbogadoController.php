<?php

namespace App\Http\Controllers\Notificaciones;

use App\Http\Controllers\Controller;
use App\Models\I4\SigcAbogado;
use App\Models\I4\SigcHechoSujetoAbogado;
use App\Models\Notificacion\Abogado;
use Illuminate\Http\Request;

class AbogadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abogados=Abogado::all();

        return $this->showAll($abogados,200);
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
        $abogados = SigcHechoSujetoAbogado::where('hecho_sujeto_id',$id)
                                    ->where('estado',1)
                                    ->get();
        $abog = array();
        $estado= false;
        foreach ($abogados as $key)
        {
            if ($key->estado === 1) {
                $estado = true;
            }
            else
            {
                $estado = false;
            }
            $abogado = SigcAbogado::where('id',$key->abogado_id)->first();
            $abog[] =[
                    'ci'              => $abogado->n_documento,
                    'nombres'         => $abogado->nombre,
                    'primerApellido'  => $abogado->ap_paterno,
                    'segundoApellido' => $abogado->ap_materno,
                    'fechaNacimiento' => $abogado->f_nacimiento,
                    'matricula'       => $abogado->matricula,
                    'estado'          => $estado,
                    'fechaHoraAlta'   => $key->fh_alta,
                    'fechaHoraBaja'   => $key->fh_baja
                ];
        }
        return $abog;
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
