<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CasoDesconocidaResource;
use App\Http\Resources\CasoJuridicaResource;
use App\Http\Resources\CasoPersonaResource;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\Sujeto;
use App\Models\Denuncia\TipoSujeto;
use App\Models\Rrhh\RrhhPersona;
use App\Models\Rrhh\RrhhPersonaDesconocida;
use App\Models\Rrhh\RrhhPersonaJuridica;
use Illuminate\Http\Request;

/**
* @group Metodos Sujetos Procesales
*
*/
class CasoPersonasController extends Controller
{
    /**
     * GET obtencion SujetosProcesales.
     *
     *  Para la Obtencion de los SujetoProcesales se debe mandar una peticon a la <b>url</b> descrita abajo
     *  enviando los sigientes parametros a la variable tipo.<br>
     *  <b>tipo=1 (Persona Denunciante)</b><br>
     *  <b>tipo=2 (Persona Denunciado)</b><br>
     *  <b>tipo=3 (Persona Victima)</b><br>
     *  <b>tipo=4 (Persona Testigo)</b>
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @transformer \App\Resources\CasoPersonaResource
     * @transformer \App\Resources\CasoJuridicaResource
     * @transformer \App\Resources\CasoDesconocidaResource
     * @return \Illuminate\Http\Response
     */
    public function index($hecho)
    {

        $tipo=  isset($_GET['tipo'])?$_GET['tipo']: 5;
        $tipoSujeto1 = TipoSujeto::where('id',intval($tipo))->select('id')->first();
        

        if ($tipoSujeto1['id'] != $tipo) {
            return $this->errorResponse('Does not exists any endpoint for this URL',422);
        }

        $reserva = Hecho::where('codigo',$hecho)->where('reserva',1)->select('reserva')->first();
        //dd($reserva->id);
        if($reserva['reserva'] === 1)
        {
            return $this->errorResponse('El caso es reservado no tiene acceso',401);
        }else{
            $personas = Hecho::where('codigo',$hecho)->first()->personas()->where('tipo_sujeto_id',$tipoSujeto1->id)->orderBy('id')->get();
            
            $perosonaTransform = CasoPersonaResource::collection($personas); //ok funcion corecta
            
            $personasJuridica = Hecho::where('codigo',$hecho)->first()->juridica()->where('tipo_sujeto_id',$tipoSujeto1->id)->orderBy('id')->get();

            $perJuridTransform = CasoJuridicaResource::collection($personasJuridica);
            
            $personasDesco = Hecho::where('codigo',$hecho)->first()->personaDesconocida()->where('tipo_sujeto_id',$tipoSujeto1->id)->orderBy('id')->get();

            
            $perDescoTranform = CasoDesconocidaResource::collection($personasDesco);

            if ($personas->isNotEmpty() && $personasJuridica->isNotEmpty() && $personasDesco->isNotEmpty()) {
                
                $sujetosx = $perosonaTransform->merge($perJuridTransform);
                $sujetosProceales = $sujetosx->merge($perDescoTranform);

                return $this->showAll($sujetosProceales);
            }else
            {   
                if($personas->isEmpty() && $personasJuridica->isEmpty() && $personasDesco->isEmpty()){

                    return $this->errorResponse('no existen sujetos en esta categoria',422);

                }elseif ($personas->isNotEmpty() && $personasJuridica->isNotEmpty() || $personasDesco->isEmpty()) {

                    $sujetosProceales = $perosonaTransform->merge($perJuridTransform);
                    return $this->showAll($sujetosProceales);

                }elseif ($personas->isNotEmpty() && $personasDesco->isNotEmpty() || $personasJuridica->isEmpty()) {

                    $sujetosProceales = $perosonaTransform->merge($perDescoTranform);
                    return $this->showAll($sujetosProceales);

                }elseif ($personasJuridica->isNotEmpty() && $personasDesco->isNotEmpty() || $personas->isNotEmpty()) {

                    $sujetosProceales = $perJuridTransform->merge($perDescoTranform);
                    return $this->showAll($sujetosProceales);
                }
            }
        }
          
    }

    /**
     * Metodo POST para registro de Sujetos Procesales.
     *
     * En este metodo debe mandarse la informacion Generada en las Instituciones con acceso a esta API
     * cade vez que se genere un nuevo tipo de Sujeto Procesal se de ma andar 2 parametros adicionales
     * como ser el <b>tipo=</b> y el <b>es_persona=</b> donde los parametros van de acuerdo a lo sgt<br>
     * <b>tipo=1 (Persona Denunciante)</b><br>
     * <b>tipo=2 (Persona Denunciado)</b><br>
     * <b>tipo=3 (Persona Victima)</b><br>
     * <b>tipo=4 (Persona Testigo)</b><br>
     * <b>es_persona=0 (Persona Juridica)</b><br>
     * <b>es_persona=1 (Persona natural)</b><br>
     * <b>es_persona=2 (Persona Desconocida y/o Extranjera)</b><br>
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $hecho)
    {
        $tipo=  isset($_GET['tipo'])?$_GET['tipo']: 5;
        $tipo_persona=  isset($_GET['es_persona'])?$_GET['es_persona']: 5;

        $tipoSujeto1 = TipoSujeto::where('id',intval($tipo))->select('id')->first()->id;
        
         if ($tipoSujeto1['id'] != $tipo && ($tipo_persona>2 || $tipo_persona<0 || $tipo_persona =='')) {
            
            return $this->errorResponse('Does not exists any endpoint for this Caso '.$hecho,422);
        
        }else{
            $id_hechopersona = '';
            $hecho_persona = new Sujeto();
            switch ($tipo_persona) {
                case 1:

                    $datos = $request->validate([
                        'es_victima' => 'required|numeric',
                        'n_documento' => 'required|max:250|string',
                        'tipo_documento' => 'required|max:250|string',
                        'nombre'=> 'required|max:250|string',
                        'ap_paterno' => 'required|max:250|string',
                        'ap_materno' => 'required|max:250|string',
                        'sexo' => 'required|max:250|string',
                        'genero' => 'numeric',
                        'municipio_id_residencia' => 'required|max:250|string',
                        'f_nacimiento' => 'required|date',
                        'pais_id' => 'numeric',

                        'idioma_id' => 'required|numeric',
                        'autoidentificacion_id' => 'required|numeric',
                        'nivel_educacion_id' => 'string',
                        'domicilio' => 'required|string',
                        'telefono' => 'max:250',
                                    
                        'map_latitud' => 'required|numeric',
                        'map_longitud' => 'required|numeric',
                    ]);

                    $c_n_documento = RrhhPersona::where('n_documento', $request->n_documento)->first();

                    if($c_n_documento['id']<1)
                    {
                        
                        $persona_id = $this->guardarPersonaNatural($request,$tipo);

                    }else{
                        $persona_id = $c_n_documento['id'];

                    }
                   
                    $hecho_persona->persona_id = $persona_id;
                    $hecho_id = Hecho::where('codigo',$hecho)->select('id')->first();
                    $hecho_persona->hecho_id = $hecho_id['id'];
                    $hecho_persona->tipo_sujeto_id = $tipo;
                    $hecho_persona->relacion_victima_id = $request->relacion_victima_id;
                    $hecho_persona->nivel_educacion_id = $request->nivel_educacion_id;
                    $hecho_persona->grupo_vulnerable_id = $request->grupo_vulnerable_id;
                    $hecho_persona->grado_discapacidad_id = $request->grado_discapacidad_id;
                    $hecho_persona->autoidentificacion_id = $request->autoidentificacion_id;
                    $hecho_persona->busqueda_ci = $request->n_documento;
                    $hecho_persona->busqueda_nombre = $request->nombre.' '.$request->ap_paterno.' '.$request->ap_materno.' '.$request->ap_esposo;
                    $hecho_persona->busqueda_edad = $request->edad;
                    $hecho_persona->busqueda_sexo = $request->sexo;
                    $hecho_persona->busqueda_celular = $request->celular;
                    $hecho_persona->busqueda_domicilio = $request->domicilio;
                    $hecho_persona->busqueda_longitude = $request->map_longitud;
                    $hecho_persona->busqueda_latitude = $request->map_latitud;
                    $hecho_persona->estado_procesal = $request->estado_procesal_id;
                    if ($request->es_victima)
                        {$hecho_persona->es_victima = 1;}
                    $hecho_persona->save();
                    $id_hechopersona=$hecho_persona->busqueda_nombre; //ver si se inserto la persona
                    break;
                case 0:

                    $nit = RrhhPersonaJuridica::where('nit', $request->nit)->first();

                    if($nit['id']<1)
                    {
                        
                        $persona_juridica_id1 = $this->guardarPersonaJuridica($request);

                    }else{
                        $persona_juridica_id1 = $nit['id'];

                    }

                    $datos = $request->validate([
                        'es_victima' => 'required|numeric',
                        'nit' => 'required',
                        'razon_social' => 'required',
                        'domicilio' => 'required|string',
                        'telefono' => 'max:250',
                        'municipio_id' =>'numeric',
                                    
                        'map_latitud' => 'required|numeric',
                        'map_longitud' => 'required|numeric',
                    ]);

                    $hecho_persona->persona_juridica_id = $persona_juridica_id1;
                    $hecho_id = Hecho::where('codigo',$hecho)->select('id')->first();
                    $hecho_persona->hecho_id = $hecho_id['id'];
                    $hecho_persona->tipo_sujeto_id = $tipo;
                    $hecho_persona->busqueda_ci = $request->nit;
                    $hecho_persona->busqueda_nombre = $request->razon_social;
                    $hecho_persona->busqueda_domicilio = $request->domicilio;
                    $hecho_persona->relacion_victima_id = $request->relacion_victima_id;
                    $hecho_persona->estado_procesal = $request->estado_procesal_id;
                    $hecho_persona->es_persona = 0;
                    $hecho_persona->save();
                    $id_hechopersona=$hecho_persona->busqueda_nombre;
                    break;
                
                case 2:
                    $persona_desconocida_id = $this->guardarPersonaDesconocida($request);
                    $hecho_persona->persona_desconocida_id = $persona_desconocida_id;
                    $hecho_id = Hecho::where('codigo',$hecho)->select('id')->first();
                    $hecho_persona->hecho_id = $hecho_id['id'];
                    $hecho_persona->tipo_sujeto_id = $tipo;
                    $hecho_persona->busqueda_nombre = $request->nombre.' '.$request->ap_paterno.' '.$request->ap_materno;
                    $hecho_persona->es_persona = 2;
                    $hecho_persona->relacion_victima_id = $request->relacion_victima_id;
                    $hecho_persona->estado_procesal = $request->estado_procesal_id;
                    $hecho_persona->grupo_vulnerable_id = $request->grupo_vulnerable_id;
                    $hecho_persona->estado_libertad_id = $request->estado_libertad_id;
                    $hecho_persona->save();
                    $id_hechopersona=$hecho_persona->busqueda_nombre;
                    break;
            }
            if ($id_hechopersona!= '')
                return $this->successConection('datos llenados correctamente en el caso '.$hecho.' de la persona '.$id_hechopersona,201 );
            else
            {
                return $this->errorResponse('prevalidador',422);
            } 
        }        
    }

    /**
     * Metodo PUT para Actualizar los datos de un Sujeto Procesal.
     *
     * este metodo aceptamos 2 tipos de parametros extra que son el <b>Tipo de sujeto Procesal</b> y el <b>n_documento</b> 
     * <b>tipo=1 (Persona Denunciante)</b><br>
     * <b>tipo=2 (Persona Denunciado)</b><br>
     * <b>tipo=3 (Persona Victima)</b><br>
     * <b>tipo=4 (Persona Testigo)</b><br>
     * <b>n_documento= 7864815 (Carnet de Identida, Pasaporte, etc)</b><br>  
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

    private function guardarPersonaNatural($request, $tipo)
    {
            $map_latitud='';
            $map_longitud='';
            if($tipo  == 1){ //mando boolean llega  si es true
                $map_latitud=$request->map_latitud;
                $map_longitud=$request->map_longitud;
                
            }
            if($tipo  == 2){ //mando boolean llega  si es true
                $map_latitud=$request->map_latitud;
                $map_longitud=$request->map_longitud;
            }
            if($tipo  == 3){ //mando boolean llega  si es true
                $map_latitud=$request->map_latitud;
                $map_longitud=$request->map_longitud;
            }
            $request->merge([
                'map_latitud' => $map_latitud,
                'map_longitud' => $map_longitud ,
            ]);
            //dd($request);
            $persona= (new RrhhPersona)->fill($request->all());
            $persona->save();
            return $persona->id;
    }

    private function guardarPersonaJuridica($request)
    {
        $persona_juridica= new RrhhPersonaJuridica();
        $persona_juridica->nit = $request->nit;
        $persona_juridica->razon_social = $request->razon_social;
        $persona_juridica->telefono = $request->telefono;
        $persona_juridica->domicilio = $request->domicilio;
        $persona_juridica->map_latitud = $request->map_latitud;
        $persona_juridica->map_longitud = $request->map_latitud;
        $persona_juridica->save();
        return $persona_juridica->id;
    }

    private function guardarPersonaDesconocida($request)
    {
        $persona_desconocida = new RrhhPersonaDesconocida();
        $persona_desconocida->nombre = $request->nombre;
        $persona_desconocida->ap_paterno = $request->ap_paterno;
        $persona_desconocida->ap_materno = $request->ap_materno;
        $persona_desconocida->pais_id = $request->pais_id;
        $persona_desconocida->descripcion = 'nombre: '.$request->nombre.', alias: '.$request->alias.', estatura: '.$request->estatura.', color de Tez: '.$request->tez.', Tipo de Veztimenta: '.$request->vestimenta.', Senia Particular: '.$request->senia.', peso Aproximado: '.$request->peso.', color de Cabello: '.$request->cabello;
        $persona_desconocida->save();
        return $persona_desconocida->id;
    }
}
