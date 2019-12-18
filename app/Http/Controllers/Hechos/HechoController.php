<?php

namespace App\Http\Controllers\Hechos;

use App\Http\Controllers\Controller;
use App\Models\Denuncia\Hecho;
use App\Models\Notificacion\Caso;
use App\Models\Notificacion\CasoFuncionario;
use App\Models\Notificacion\Delito;
use App\Models\Notificacion\EstadoCaso;
use App\Models\Notificacion\Funcionario;
use App\Models\Notificacion\Persona;
use Illuminate\Http\Request;

class HechoController extends Controller
{
    /**
     * Muestra un lista de los Hecho.
     *  Mediante una llamada al metodo get de la URL designada como en el ejemplo podemos obtener un lista de todos los echos realizados divididos en una paginacion de 5 hechos
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
        $datos = $request->validate([
            'codigo' => 'required|max:20',
            'relato' => 'required',
            'conducta'=> 'required',
            'resultado' => 'required',
            'circunstancia' => 'required'
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
    public function show($id, Request $request)
    {
        $gestion = isset($_GET['gestion'])?$_GET['gestion']: 5;

        $caso = Caso::where('Caso',$id)->first();

        if (!$caso) {
            $caso = Caso::where('Caso',$id.'/'.$gestion)->first();
            if (!$caso) {
                return $this->errorResponse('no se encontro el Caso', 422);
            }
        }

        $delitos = Delito::where('ClaseDelito',11)->select('id')->get();

                $personaDenunciante = Persona::where('Caso',$caso->id)->where('EsDenunciante',1)->get();
                $personaDenunciado= Persona::where('Caso',$caso->id)->where('EsDenunciado',1)->get();
                $estadoCaso = EstadoCaso::where('id',$caso->EstadoCaso)->first();

                $casoFuncionario = CasoFuncionario::where('Caso', $caso->id)->orderBy('UpdaterDate','desc')->first();

                if (!$casoFuncionario)
                {
                    $respuesta['mensaje'] = 'No existe funcionaro en este caso.';
                    // \Log::warning('CASO FUNCIONARIO I4: No existe el funcionaro en este caso.');
                    return $respuesta;
                }

                $funcionarioasig = Funcionario::where('id',$casoFuncionario->Funcionario)->first();

                $denunciantes = array();

                foreach ($personaDenunciante as $value)
                {
                    $denunciantes[] = [
                            'nombre_completo'  => $value->Persona,
                            'carnet_identidad' => $value->NumDocId,
                            'Zona'             => $value->ZonaDom,
                            'Direccion'        => $value->DirDom
                        ];
                };

                $denunciados = array();

                foreach ($personaDenunciado as $valor)
                {
                    $denunciados[] = [
                            'nombre_completo'  => $valor->Persona,
                            'carnet_identidad' => $valor->NumDocId,
                            'Zona'             => $valor->ZonaDom,
                            'Direccion'        => $valor->DirDom
                        ];
                };

                $casotrans =[
                    'fecha_denuncia'    => $caso->FechaDenuncia,
                    'codigo_FUD'        => $caso->Caso,
                    'fecha_hecho'       => $caso->FechaHecho.' '.$caso->HoraHecho,
                    'lugar_hecho'       => 'Zona: '.$caso->Zona.'Direccion: '.$caso->Dir,
                    'descripcion_hecho' => $caso->BreveDescripcionHecho,
                    'delito_principal'  => $caso->DelitoPrincipal,
                    'fiscal_asignado'   => $funcionarioasig->Nombres.' '.$funcionarioasig->ApPat.' '.$funcionarioasig->ApMat,
                    'denunciates'       => $denunciantes,
                    'denunciados'       => $denunciados,
                    'estado_caso'       => $estadoCaso->EstadoCaso,


                ];

                return $casotrans;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hecho = Hecho::where('codigo', $id)->first();

        $datos = $request->validate([
            'relato' => 'max:300|min:5',
            'conducta' => 'max:255|min:5'
            ]);

        $hecho->fill($request->only([
            'relato',
            'conducta'
        ]));
        if ($hecho->isClean()){

            return $this->errorResponse('por favor especifique un diferente valor', 422);
        }
        $hecho->save();

        return $this->successMesagesResponse('el caso se actualizo con exito', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hecho = Hecho::where('codigo', $id)->first();
        //implemetar el delete
        return response()->json(['data'=> 'se elimino con exito de manera logica'], 200);
    }
}
