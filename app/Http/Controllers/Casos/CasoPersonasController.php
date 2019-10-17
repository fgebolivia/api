<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CasoDesconocidaResource;
use App\Http\Resources\CasoJuridicaResource;
use App\Http\Resources\CasoPersonaResource;
use App\Libraries\SegipClass;
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
     * @response
        {
            "página_actual": 1,
            "data": [
                {
                    "es_persona_valida": 1,
                    "provincia_nacimiento": null,
                    "municipio_nacimiento": null,
                    "provincia_residencia": "JAIME ZUDAÑEZ",
                    "municipio_residencia": "ICLA (R.MUJIA)",
                    "n_documento": "7894562",
                    "nombre": "EFRAIN",
                    "ap_paterno": "PELAEZ",
                    "ap_materno": "FERNANDEZ",
                    "ap_esposo": "VALDEZ",
                    "sexo": "M",
                    "fecha_nacimiento": "1983-12-01",
                    "estado_civil": null,
                    "domicilio": "avda. MAX FERNANDEZ",
                    "telefono": null,
                    "celular": "79537750",
                    "profesion_ocupacion": "ING.  OF SYS",
                    "pueblo_originario": null,
                    "lugar_trabajo": null,
                    "domicilio_laboral": null,
                    "telefono_laboral": null,
                    "alias": null,
                    "estatura": null,
                    "tez": null,
                    "edad": null,
                    "vestimenta": null,
                    "senia": null,
                    "peso": null,
                    "cabello": null,
                    "genero": 0,
                    "email": null,
                    "ojos": null,
                    "ciudadano_digital": 0,
                    "relacion_victima": "MADRE",
                    "nivel_educacion": "SECUNDARIA",
                    "grupo_vulnerable": "ADULTO MAYOR",
                    "grado_discapacidad": null,
                    "estado_libertad": null,
                    "fecha_estado_procesal": null
                },
                {
                    "es_persona_valida": 1,
                    "provincia_nacimiento": null,
                    "municipio_nacimiento": null,
                    "provincia_residencia": "OROPEZA",
                    "municipio_residencia": "YOTALA",
                    "n_documento": "4900325",
                    "nombre": "MARCELO",
                    "ap_paterno": "TITO",
                    "ap_materno": "COPA",
                    "ap_esposo": null,
                    "sexo": "M",
                    "fecha_nacimiento": "1983-10-09",
                    "estado_civil": 2,
                    "domicilio": "AV. LITORAL, EL ALTO, BOLIVIA",
                    "telefono": "8786545",
                    "celular": "465487",
                    "profesion_ocupacion": "ALBAÃ±IL",
                    "pueblo_originario": null,
                    "lugar_trabajo": "se desconoce",
                    "domicilio_laboral": "se desconoce",
                    "telefono_laboral": null,
                    "alias": null,
                    "estatura": null,
                    "tez": null,
                    "edad": null,
                    "vestimenta": null,
                    "senia": null,
                    "peso": null,
                    "cabello": null,
                    "genero": 0,
                    "email": "MATCOP@GMAIL.COM",
                    "ojos": null,
                    "ciudadano_digital": 0,
                    "relacion_victima": "CONYUGUE",
                    "nivel_educacion": null,
                    "grupo_vulnerable": null,
                    "grado_discapacidad": null,
                    "estado_libertad": null,
                    "fecha_estado_procesal": null
                },
                {
                    "es_persona_valida": 0,
                    "provincia": "LUIS CALVO",
                    "municipio": "VILLA VACA GUZMAN (MUYUPAMPA)",
                    "razon_social": "Paucek Ltd",
                    "nit": "626394652",
                    "domicilio": "4856 Randy Points Suite 194\nNew Rosannastad, NJ 46481",
                    "telefono": "+3877697129878",
                    "relacion_victima": "AUTORIDAD DE CENTRO EDUCATIVO",
                    "representante_legal": {
                        "n_documento": null,
                        "nombre_completo": null
                    }
                },
                {
                    "es_persona_valida": 0,
                    "pais": "ARGENTINA",
                    "nombre": "Americo Mosciski",
                    "ap_paterno": "Erwin",
                    "ap_materno": "Wuckert",
                    "descripcion": "Ab facere maiores delectus voluptatibus quo. Mollitia inventore dolor quo omnis animi harum ut. Expedita quia assumenda soluta praesentium.",
                    "sexo": null,
                    "fecha_nacimiento": null,
                    "estado_civil": null,
                    "domicilio": null,
                    "telefono": null,
                    "celular": null,
                    "profesion_ocupacion": null,
                    "pueblo_originario": null,
                    "lugar_trabajo": null,
                    "domicilio_laboral": null,
                    "telefono_laboral": null,
                    "alias": null,
                    "estatura": null,
                    "tez": null,
                    "edad": null,
                    "vestimenta": null,
                    "senia": null,
                    "peso": null,
                    "cabello": null,
                    "genero": 0,
                    "email": null,
                    "ojos": null,
                    "relacion_victima": "AUTORIDAD POLITICA",
                    "nivel_educacion": "SECUNDARIA",
                    "grupo_vulnerable": "ADULTO MAYOR",
                    "grado_discapacidad": "INTELECTUAL",
                    "estado_libertad": null,
                    "fecha_estado_procesal": null
                }
            ],
            "url_primera_pagina": "http://api-dev3.fiscalia.gob.bo/api/v2/casos/324727/sujetosprocesales?tipo=1&page=1",
            "desde": 1,
            "ultima_pagina": 1,
            "url_ultima_pagina": "http://api-dev3.fiscalia.gob.bo/api/v2/casos/324727/sujetosprocesales?tipo=1&page=1",
            "url_pagina_siguiente": null,
            "path": "http://api-dev3.fiscalia.gob.bo/api/v2/casos/324727/sujetosprocesales",
            "por_pagina": 5,
            "purl_pagina_anterior": null,
            "a": 4,
            "total": 4
        }
     */
    public function index($hecho)
    {

        $tipo=  isset($_GET['tipo'])?$_GET['tipo']: 5;
        $tipoSujeto1 = TipoSujeto::where('id',intval($tipo))->first();
        
        if ($tipoSujeto1 == null) {
            return $this->errorResponse('no existe el tipo de sujeto '.$tipo,422);
        }

        if ($tipoSujeto1->id != $tipo) {
            return $this->errorResponse('Does not exists any endpoint for this URL',422);
        }

        $reserva = Hecho::where('codigo',$hecho)->first();
        //dd($reserva->reserva);
        if($reserva->reserva === 1)
        {
            return $this->errorResponse('El caso es reservado no tiene acceso',401);
        }else{
            $personas = Hecho::where('codigo',$hecho)->first()->personas()->where('tipo_sujeto_id',$tipoSujeto1->id)->where('deleted',0)->orderBy('id')->get();
            
            $perosonaTransform = CasoPersonaResource::collection($personas); //ok funcion corecta
            
            $personasJuridica = Hecho::where('codigo',$hecho)->first()->juridica()->where('tipo_sujeto_id',$tipoSujeto1->id)->where('deleted',0)->orderBy('id')->get();

            $perJuridTransform = CasoJuridicaResource::collection($personasJuridica);
            
            $personasDesco = Hecho::where('codigo',$hecho)->first()->personaDesconocida()->where('tipo_sujeto_id',$tipoSujeto1->id)->where('deleted',0)->orderBy('id')->get();

            
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
     * <b>tipo=1 (Persona Denunciante)  |</b> <b>es_persona=0 (Persona Juridica)</b><br>
     * <b>tipo=2  (Persona Denunciado)  |</b> <b>es_persona=1 (Persona natural)</b><br>
     * <b>tipo=3    (Persona Victima)   |</b> <b>es_persona=2 (Persona Desconocida y/o Extranjera)</b><br>
     * <b>tipo=4    (Persona Testigo)   |</b><br>
     *<p><b>CAMPOS DE INSERCION EN EL POST-PERSONA NATURAL O DESCONOCIDA</b></p>
     * @bodyParam es_victima integer opcional 0=no es victima | 1=es victima
       @bodyParam es_persona_valida integer required persona_Natural=1, Jurídica=1 o Desconocida=0
       @bodyParam codigo_municipio_residencia string required Municipio de residencia de una persona
       @bodyParam n_documento string required Carnet de identidad de la una persona válida por el SEGIF
       @bodyParam nombre string required Nombre de la persona natural
       @bodyParam ap_paterno string required Apellido paterno de la persona natural
       @bodyParam ap_materno string required Apellido materno de la persona natural
       @bodyParam ap_esposo string required Apellido esposo de la persona natural
       @bodyParam sexo date opcional Sexo de la persona natural
       @bodyParam fecha_nacimiento date required Fecha de nacimiento de la persona natural (Ejemplo 2019-10-24 15:30:15)
       @bodyParam estado_civil numeric opcional Estado civil de la persona natural
       @bodyParam domicilio boolean opcional Domicilio de la persona natural
       @bodyParam telefono numeric opcional Teléfono de la persona natural
       @bodyParam celular string opcional Celular de la persona natural
       @bodyParam profesion_ocupacion string opcional Profesión de la persona natural
       @bodyParam pueblo_originario string opcional Pueblo originario del que se considera la persona natural
       @bodyParam lugar_trabajo string opcional Lugar de trabajo de la persona natural
       @bodyParam domicilio_laboral date opcional Domicilio de donde trabaja la persona natural
       @bodyParam telefono_laboral string opcional Teléfono del lugar donde trabaja la persona natural
       @bodyParam alias numeric opcional Alias de la persona natural
       @bodyParam estatura boolean opcional Estatura de la persona natural
       @bodyParam tez numeric opcional Tes de la persona natural
       @bodyParam edad string opcional Edad de la persona natural
       @bodyParam vestimenta string opcional Vestimenta de la persona natural
       @bodyParam senia string Señas particulares de la persona natural
       @bodyParam peso string opcional Peso de la persona natural
       @bodyParam cabello date opcional Cabello de la persona natural
       @bodyParam email numeric opcional Email de la persona natural
       @bodyParam ojos boolean opcional Color de ojos de la persona natural
       @bodyParam ciudadano_digital numeric required Tipo booleano  devuelve 0: si no es ciudadano Digital o 1: si es ciudadano digital
       @bodyParam relacion_victima integer opcional id del catálogo de relación con la víctim
       @bodyParam nivel_educacion integer opcional id del catálogo del grado de educación recibida
       @bodyParam grupo_vulnerable integer opcional id del catálogo  grupo vulnerable
       @bodyParam grado_discapacidad integer opcional id del catálogo grado de discapacidad
       @bodyParam estado_procesal integer opcional id del estado procesal en el que se encuentra actualmente 
       @bodyParam fecha_estado_procesal date opcional fecha en la que  se llevo acabo el estado procesal en el que se encuentra actualment
     *
     * <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
     *
     * @bodyParam nit integer required Número de Identificación Tributaria de la persona jurídica
       @bodyParam razon_social string required Nombre de la Empresa
       @bodyParam domicilio string opcional Domicilio de la empresa
       @bodyParam telefono string opcional Teléfono de la empresa
       @bodyParam map_latitud string required Latitud de la ubicación de la empresa
       @bodyParam map_longitud string required Longitud de la ubicación de la empresa
       @bodyParam n_documento_representante_legal string required Ci del representante legal de la persona jurídica para validacion
       @bodyParam Nombre_representante_legal string required Nombre del representante legal de la persona jurídica para validación
       @bodyParam ap_paterno_representante_legal string required Apellido Paterno del representante legal de la persona jurídica para validación
       @bodyParam ap_materno_representante_legal string required Apellido Materno del representante legal de la persona jurídica para validación
       @bodyParam fecha_nacimiento_representante_legal date required Fecha de nacimiento de la persona natural (Ejemplo 2019-10-24 15:30:15)
     *  
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     * @response
     *  {
     *  "message": "datos llenados correctamente en el caso xxxxxx",
     *  "code": 201
     *  }
     */
    public function store(Request $request, $hecho)
    {
        $tipo=  isset($_GET['tipo'])?$_GET['tipo']: 5;
        $tipo_persona =  isset($_GET['es_persona'])?$_GET['es_persona']: 2;

        $tipoSujeto1 = TipoSujeto::where('id',intval($tipo))->select('id')->first();

        if ($tipoSujeto1 == null) {

            return $this->errorResponse('no existe el tipo de sujeto '.$tipo,422);
        }
        //dd($tipoSujeto1->id);
        if ( $tipoSujeto1->id == $tipo && ($tipo_persona == 1 || $tipo_persona == 0 || $tipo_persona == 2)) {

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
                        'fecha_nacimiento' => 'required|date',
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
                    
                    if($c_n_documento == null)
                    {
                        $persona_id = $this->guardarPersonaNatural($request,$tipo);
                        if($persona_id == null){
                            return $this->errorResponse('los datos de la persona no son validos coriga por favor',422);
                        }

                    }else{
                        $persona_id = $c_n_documento->id;
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

                    $id_hechopersona=$hecho_persona->id; //ver si se inserto la persona
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
                    $id_hechopersona=$hecho_persona->id;
                    break;
                
                case 2:
                    $datos = $request->validate([
                        'nombre' => 'required|max:250|string',
                    ]);
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
                    $id_hechopersona=$hecho_persona->id;
                    break;
            }
            if ($id_hechopersona != '')
                //return $this->successConection('datos llenados correctamente en el caso '.$hecho.' de la persona '.$id_hechopersona,201 );
                return response()->json(['message'=> 'datos llenados correctamente en el caso '.$hecho, 'code' => 201, 'codigo_sujeto_procesal' => $id_hechopersona],201);
            else
            {
                return $this->errorResponse('prevalidador',422);
            }    
        }else{
            return $this->errorResponse('los campos tipo o es_persona no son validos para este Caso '.$hecho,422);     
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
     * <b>es_persona=0 (Persona Juridica)</b><br>
     * <b>es_persona=1 (Persona natural)</b><br>
     * <b>es_persona=2 (Persona Desconocida y/o Extranjera)</b><br>
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @param  \App\Models\Rrhh\RrhhPersona  $rrhhPersona
     * @return \Illuminate\Http\Response
     * @response
     *  {
     *  "message": "datos Actualizados correctamente en el caso xxxxxx",
     *  "code": 201
     *  }
     */
    public function update(Request $request, $hecho, $sujetosprocesales)
    {
        $tipo=  isset($_GET['tipo'])?$_GET['tipo']: 5;
        $tipo_persona=  isset($_GET['es_persona'])?$_GET['es_persona']: 5;

        $tipoSujeto1 = TipoSujeto::where('id',intval($tipo))->select('id')->first();

        if ($tipoSujeto1 == null) {
            return $this->errorResponse('no existe el tipo de sujeto '.$tipo,422);
        }

        if ($tipoSujeto1->id != $tipo && ($tipo_persona>2 || $tipo_persona<0 || $tipo_persona =='')) {
            
            return $this->errorResponse('Does not exists any endpoint for this Caso '.$hecho,422);
        
        }else{

            $hecho_persona = Sujeto::find($sujetosprocesales);
            //dd($request->nit);
            switch ($tipo_persona) {
                case 1:
                    $this->editarPersonaNatural($request, $sujetosprocesales);
                    $hecho_persona->relacion_victima_id = $request->relacion_victima_id;
                    $hecho_persona->nivel_educacion_id = $request->nivel_educacion_id;
                    $hecho_persona->grupo_vulnerable_id = $request->grupo_vulnerable_id;
                    $hecho_persona->grado_discapacidad_id = $request->grado_discapacidad_id;
                    $hecho_persona->busqueda_ci = $request->n_documento;
                    $hecho_persona->busqueda_nombre = $request->nombre;
                    $hecho_persona->busqueda_edad = $request->edad;
                    $hecho_persona->busqueda_sexo = $request->sexo;
                    $hecho_persona->busqueda_celular = $request->celular;
                    $hecho_persona->busqueda_domicilio = $request->domicilio;
                    $hecho_persona->busqueda_longitude = $request->map_longitud;
                    $hecho_persona->busqueda_latitude = $request->map_latitud;
                    if ($request->sexo == 'F')
                        $hecho_persona->busqueda_aplicar_medidas = 2;
                    if ($request->edad < 18)
                        $hecho_persona->busqueda_aplicar_medidas = 1;
                    if ($request->es_victima)
                        $hecho_persona->es_victima = 1;
                    $hecho_persona->save();
                    $id_hechopersona = $hecho_persona->id;
                    break;
                case 0:
                    $this->editarPersonaJuridica($request, $sujetosprocesales);
                    $hecho_persona->busqueda_ci = $request->nit;
                    $hecho_persona->busqueda_nombre = $request->razon_social;
                    $hecho_persona->busqueda_domicilio = $request->domicilio;
                    $hecho_persona->busqueda_longitude = $request->map_longitud;
                    $hecho_persona->busqueda_latitude = $request->map_latitud;
                    $hecho_persona->save();
                    $id_hechopersona = $hecho_persona->id;
                    break;
                case 2:
                    $persona_desconocida_id = $this->editarPersonaDesconocida($request, $sujetosprocesales);
                    $hecho_persona->persona_id = $persona_desconocida_id;
                    $hecho_persona->hecho_id = $request->hecho_id;
                    $hecho_persona->tipo_sujeto_id = $request->tipo_sujeto_id;
                    $hecho_persona->busqueda_nombre = $request->nombre . ' ' . $request->ap_paterno . ' ' . $request->ap_materno;
                    $hecho_persona->es_persona = 2;
                    $hecho_persona->save();
                    $id_hechopersona = $hecho_persona->id;
                    break;
            }
            if ($id_hechopersona!= '')
                //return $this->successConection('datos llenados correctamente en el caso '.$hecho.' de la persona '.$id_hechopersona,201 );
                return response()->json(['message'=> 'datos Actualizados correctamente en el caso '.$hecho, 'code' => 201, 'codigo_sujeto_procesal' => $id_hechopersona],201);
            else
            {
                return $this->errorResponse('prevalidador',422);
            }

        }
    }

    /**
     * Metodo DELETE para eliminar un Sujeto Procesal
     *
     * este metodo aceptamos 2 tipos de parametros extra que son el <b>Tipo de sujeto Procesal</b> y el <b>n_documento</b> 
     * <b>tipo=1 (Persona Denunciante)</b><br>
     * <b>tipo=2 (Persona Denunciado)</b><br>
     * <b>tipo=3 (Persona Victima)</b><br>
     * <b>tipo=4 (Persona Testigo)</b><br>
     * <b>es_persona=0 (Persona Juridica)</b><br>
     * <b>es_persona=1 (Persona natural)</b><br>
     * <b>es_persona=2 (Persona Desconocida y/o Extranjera)</b><br>
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @param  \App\Models\Rrhh\RrhhPersona  $rrhhPersona
     * @return \Illuminate\Http\Response
     * @response
     *  {
     *  "message": "datos eliminados correctamente en el caso xxxxxx",
     *  "code": 201
     *  }
     */
    public function destroy(Hecho $hecho, RrhhPersona $rrhhPersona)
    {
        //
    }

     private function editarPersonaNatural($request, $sujetosprocesales)
    {
        $sujeto = Sujeto::find($sujetosprocesales);
        $request->merge([
            'map_latitud' => $request->map_latitud,
            'map_longitud' => $request->map_longitud,
        ]);
        RrhhPersona::find($sujeto->persona_id)->update($request->all());
    }

    private function editarPersonaJuridica($request, $sujetosprocesales)
    {
        $sujeto = Sujeto::find($sujetosprocesales);
        $request->merge([
            'map_latitud' => $request->map_latitud,
            'map_longitud' => $request->map_longitud,
        ]);
        //dd($sujeto->id);
        RrhhPersonaJuridica::find($sujeto->persona_juridica_id)->update($request->all());
    }

    private function editarPersonaDesconocida($request, $sujetosprocesales)
    {
        $sujeto = Sujeto::find($sujetosprocesales);
        $request->merge([
            'map_latitud' => $request->map_latitud,
            'map_longitud' => $request->map_longitud,
        ]);
        RrhhPersonaDesconocida::find($sujeto->persona_desconocida_id)->update($request->all());
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

            $segip = new SegipClass();
            $data = [
                'n_documento'  => $request->n_documento,
                'complemento'  => $request->complemento,
                'nombre'       => $request->nombre,
                'ap_paterno'   => $request->ap_paterno,
                'ap_materno'   => $request->ap_materno,
                'f_nacimiento' => $request->fecha_nacimiento
            ];

            $respuesta1 = $segip->getCertificacionSegip($data);

            if ($respuesta1['sw'] == 1) {
                if ($respuesta1['respuesta']['EsValido'] == true && $respuesta1['respuesta']['CodigoRespuesta'] == 2)
                {
                    $file_name = uniqid('certificacion_segip_', true) . ".pdf";
                    $file      = public_path('/storage/segip') . "/" . $file_name;
                    file_put_contents($file, $respuesta1['respuesta']['ReporteCertificacion']);
                    
                    $persona = new RrhhPersona();

                    $persona->n_documento               = $request->n_documento;
                    $persona->nombre                    = $request->nombre;
                    $persona->ap_paterno                = $request->ap_paterno;
                    $persona->ap_materno                = $request->ap_materno;
                    $persona->f_nacimiento              = $request->fecha_nacimiento;
                    $persona->sexo                      = $request->sexo;
                    $persona->genero                    = $request->genero;
                    $persona->municipio_id_residencia   = $request->municipio_id_residencia;
                    $persona->idioma_id                 = $request->idioma_id;
                    $persona->domicilio                 = $request->domicilio;
                    $persona->telefono                  = $request->telefono;
                    $persona->map_latitud               = $request->map_latitud;
                    $persona->map_longitud              = $request->map_longitud;
                    $persona->estado_segip              = 2;
                    $persona->nombre_completo           = $request->nombre.' '.trim($request->ap_paterno.' '.$request->ap_materno);
                    $persona->certificacion_segip       = base64_encode($respuesta1['respuesta']['ReporteCertificacion']);
                    $persona->certificacion_file_segip  = $file_name;

                    $persona->save();
                    return $persona->id;
                }else
                {
                    return null;
                }
            }else
            {
                return null;
            }
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
        $persona_desconocida->sexo = $request->sexo;
        $persona_desconocida->alias = $request->alias;
        $persona_desconocida->estatura = $request->estatura;
        $persona_desconocida->tez = $request->tez;
        $persona_desconocida->vestimenta = $request->vestimenta;
        $persona_desconocida->senia = $request->senia;
        $persona_desconocida->peso = $request->peso;
        $persona_desconocida->cabello = $request->cabello;
        $persona_desconocida->pais_id = $request->pais_id;
        $persona_desconocida->descripcion = 'nombre: '.$request->nombre.', alias: '.$request->alias.', estatura: '.$request->estatura.', color de Tez: '.$request->tez.', Tipo de Veztimenta: '.$request->vestimenta.', Senia Particular: '.$request->senia.', peso Aproximado: '.$request->peso.', color de Cabello: '.$request->cabello;
        $persona_desconocida->save();
        return $persona_desconocida->id;
    }
}
