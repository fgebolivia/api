<?php

namespace App\Http\Controllers\Notificaciones;

use App\Http\Controllers\Controller;
use App\Models\Notificacion\Notificaciones;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
     * obtines una lista de todas las Notificaciones.
     * 
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $notifi=Notificaciones::all();

        return $this->showAll($notifi,200);
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
            'codigo_FUD' => 'required|max:250|string',
            'codigo_tipo_actividad' => 'required|string',
            'fecha_Actividad_solicitud' => 'required|date',
            'descripcion_actividad_solicitud' => 'required|max:550|string',
            'archivo_actividad_solicitud' => 'required|json',
            'nombre_archivo_solicitud' => 'required|string',
            'codigo_institución_solicitante' => 'required|string',
            'codigo_sujeto_solicitante' => 'required|numeric',
            'Persona_ci_solicitante' => 'required|numeric',
            'Persona_complemento_solicitante' => 'required|string',
            'Persona_nombre_solicitante' => 'required|string',
            'Persona_ap_paterno_solicitante' => 'required|string',
            'Persona_ap_materno_solicitante' => 'required|string',
            'Persona_fecha_nacimiento_solicitante' => 'required|date',
            'Asunto' => 'required|max:550|string',
            'codigo_notificacion' => 'required|numeric',
            'notificacion_electronica' => 'required|boolean',
            ]);

        //Hecho::create($datos);

        return $this->successResponse('se inserto satisfactoriamente', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notifi = Notificaciones::where('codigo', $id)->first();

        if ($notifi == null) {
            return $this->errorResponse('Does not exists any endpoint for this URL',404);
        }else{
            return $this->showOne($notifi);
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
        //dsadasadasdasdasdasddsadsadsdsadsadsadsadsaasdasdasdasdddsadsadsadsaasdasddasdsadsdsadasdasdasdasdasdasdsadsadasdasasdasdasdasdsaddsadsadasdsadasdasddasdsddsadasdasdasdsadsadsaasdasddasdadasdadasdasdasdasdasdasdsddsdadsadsdasdasasdddddddddddddddasdasdasdasdasdasdasdsadasdasdasdasd
        // fgnñlfkn
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
