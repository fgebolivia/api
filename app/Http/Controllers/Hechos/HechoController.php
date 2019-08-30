<?php

namespace App\Http\Controllers\Hechos;

use App\Http\Controllers\Controller;
use App\Models\Denuncia\Hecho;
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
    public function show($id)
    {
        $hecho = Hecho::where('codigo', $id)->first();
        return $this->showOne($hecho);
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
