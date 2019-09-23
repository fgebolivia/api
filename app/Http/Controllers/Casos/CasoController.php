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
        $hecho = Hecho::where('codigo', $id)->where('reserva',0)->first();
        if ($hecho == null) {
            return $this->errorResponse('Does not exists any endpoint for this URL',404);
        }else{
            //dd($hecho);
            $hechos1 = new CasoResource($hecho);
            return $hechos1;
        }
        
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
        $hecho = Hecho::where('codigo', $id)->where('reserva',0)->first();
        //dd($hecho);
        $data = $request->validate([

            'codigo' => 'max:250|string',
            'relato' => 'string',
            'direccion' => 'max:550|string',
            'zona' => 'max:550|string',
            'detallelocacion' => 'max:550|string',
            'municipio_id' => 'numeric',
            'created_at' => 'date',
            'longitude' => 'numeric',
            'latitude' => 'numeric',
            'tipo_denuncia_id' => 'numeric',
            'fechahorainicio' => 'date',
            'aproximado' => 'string',
            'oficina_id' => 'numeric',
            'titulo' => 'max:250',
            'user_id' => 'numeric',
        ]);

        if ($request->has('relato')) {
            $hecho->relato = $request->relato;
        }
        if ($request->has('conducta')) {
            $hecho->conducta = $request->conducta;
        }
        if ($request->has('resultado')) {
            $hecho->resultado = $request->resultado;
        }
        if ($request->has('circunstancia')) {
            $hecho->circunstancia = $request->circunstancia;
        }
        if ($request->has('direccion')) {
            $hecho->direccion = $request->direccion;
        }
        if ($request->has('zona')) {
            $hecho->zona = $request->zona;
        }
        if ($request->has('detallelocacion')) {
            $hecho->detallelocacion = $request->detallelocacion;
        }
        if ($request->has('municipio_id')) {
            $hecho->municipio_id = $request->municipio_id;
        }
        if ($request->has('longitude')) {
            $hecho->longitude = $request->longitude;
        }
        if ($request->has('latitude')) {
            $hecho->latitude = $request->latitude;
        }
        if ($request->has('tipo_denuncia_id')) {
            $hecho->tipo_denuncia_id = $request->tipo_denuncia_id;
        }
        if ($request->has('fechahorainicio')) {
            $hecho->fechahorainicio = $request->fechahorainicio;
        }
        if ($request->has('fechahorafin')) {
            $hecho->fechahorafin = $request->fechahorafin;
        }
        if ($request->has('aproximado')) {
            $hecho->aproximado = $request->aproximado;
        }
        if ($request->has('quien_hizo')) {
            $hecho->quien_hizo = $request->quien_hizo;
        }
        if ($request->has('que_hizo')) {
            $hecho->que_hizo = $request->que_hizo;
        }

        if ($request->has('aquien_hizo')) {
            $hecho->aquien_hizo = $request->aquien_hizo;
        }
        if ($request->has('como_hizo')) {
            $hecho->como_hizo = $request->como_hizo;
        }
        if ($request->has('oficina_id')) {
            $hecho->oficina_id = $request->oficina_id;
        }

        if (!$hecho->isDirty()) {
            return $this->errorResponse('por favor especifique un valor diferente',422);
        }

        $hecho->save();

        return $this->successConection('el caso se actualizo correctamente',200);

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
