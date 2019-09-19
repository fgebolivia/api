<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CasoResource;
use App\Models\Denuncia\Hecho;
use Illuminate\Http\Request;

/**
* @group Metodos para el F.U.D.
*
*/

class CasoController extends Controller
{
    /**
     * Metodo Get Genera un listado de todos los Casos existentes
     *
     * puede generar un listado de todos los casos existentes paginados cada 5 casos
     * como se puede observar en el ejemplo
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hechos = Hecho::where('reserva',0)->Paginate(5);
        //return CasoResource::collection($hechos);
         $hechos1 = CasoResource::collection($hechos);
         //dd($hechos);
        return  $hechos1;
    }

    /**
     * Metodo POST Insertar un nuevo Caso.
     *
     *  en este metodo podemos insertar todo los campos referentes al sujeto procesal<br><br>
     *  <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     *  <b>'codigo' => 'required|max:250|string'</b><br>
     *  <b>'relato' => 'required|max:250|string'</b><br>
     *  <b>'conducta'=> 'required|max:250|string'</b><br>
     *  <b>'resultado' => 'required|max:250|string'</b><br>
     *  <b>'circunstancia' => 'required|max:250|string'</b><br>
     *  <b>'direccion' => 'required|max:250|string'</b><br>
     *  <b>'zona' => 'required|max:250|string'</b><br>
     *  <b>'detallelocacion' => 'required|max:250|string'</b><br>
     *  <b>'municipio_id' => 'required|numeric'</b><br>
     *  <b>'created_at' => 'required|date'</b><br>
     *  <b>'longitude' => 'required|numeric'</b><br>
     *  <b>'latitude' => 'required|numeric'</b><br>
     *  <b>'tipo_denuncia_id' => 'required|numeric'</b><br>
     *  <b>fechahorainicio' => 'required|date'</b><br>
     *  <b>'fechahorafin' => 'required|date'</b><br>
     *  <b>'aproximado' => 'string'</b><br>
     *  <b>'oficina_id' => 'required|numeric'</b><br>
     *  <b>'titulo' => 'max:250'</b><br>
     *  <b>'user_id' => 'required|numeric'</b><br>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|max:250|string',
            'relato' => 'required|string',
            'direccion' => 'required|max:550|string',
            'zona' => 'required|max:550|string',
            'detallelocacion' => 'required|max:550|string',
            'municipio_id' => 'required|numeric',
            'created_at' => 'date',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'tipo_denuncia_id' => 'required|numeric',
            'fechahorainicio' => 'date',
            'aproximado' => 'string',
            'oficina_id' => 'required|numeric',
            'titulo' => 'max:250',
            'user_id' => 'required|numeric',
            ]);

        Hecho::create($datos);

        return $this->successResponse('se inserto satisfactoriamente', 201);
    }

    /**
     * Metodo GET para obtener un solo caso; se envia el codigo del caso en la URL.
     *
     * <p><b>CASO DE EJEMPLO</b></p>
     * <b>/v2/casos/324727</b>
     *
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hecho = Hecho::where('codigo', $id)->where('reserva',0)->select('codigo','relato','conducta','resultado','circunstancia','direccion','zona','detallelocacion','municipio_id','created_at','longitude','latitude','tipo_denuncia_id','fechahorainicio','fechahorafin','aproximado','titulo')->first();
        if ($hecho == null) {
            return $this->errorResponse('Does not exists any endpoint for this URL',404);
        }else{
            return $this->showOne($hecho);
        }
        
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
