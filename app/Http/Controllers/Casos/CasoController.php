<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CasoResource;
use App\Http\Resources\CasoSujetoResource;
use App\Models\Denuncia\Hecho;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\TipoDenuncia;
use App\Models\Rrhh\RrhhPersona;
use App\Models\UbicacionGeografica\UbgeMunicipio;
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
     @response
     {
        "data": [
            {
                "codigo_fud": "634999",
                "relato": "Et error tempore molestiae temporibus corrupti quis animi voluptatem autem et rerum.",
                "resultado": "Maxime autem.",
                "direccion_caso": "8627 McLaughlin Heights\nNew Rainatown, WY 36166",
                "detalle_localizacion": "8627 McLaughlin Heights\nNew Rainatown, WY 36166",
                "provincia": "ELIODORO CAMACHO",
                "municipio": "PUERTO CARABUCO",
                "fecha_creacion_fud": "2019-08-05 18:38:01",
                "longitud": "-66.771585",
                "latitud": "-14.090757",
                "tipo_denuncia": "ACCION DIRECTA",
                "fecha_hora_inicio": "2010-01-09 01:42:00",
                "fecha_hora_fin": "1981-08-31 18:49:23",
                "momento_aproximado": "Fuga quia earum sit veritatis.",
                "etapa_caso": "Abierto",
                "estado_caso": "Preliminar",
                "oficina": null,
                "titulo": null,
                "delito_principal": null
            },
            {
                "codigo_fud": "220518",
                "relato": "Consequatur facere nulla repellat consectetur non temporibus molestiae eos odit corrupti aut et sint fuga vel nobis commodi.",
                "resultado": "Exercitationem possimus non labore est.",
                "direccion_caso": "864 Lockman Cliff\nNew Isidro, NC 71615",
                "detalle_localizacion": "864 Lockman Cliff\nNew Isidro, NC 71615",
                "provincia": "JUANA AZURDUY DE PADILLA",
                "municipio": "VILLA AZURDUY",
                "fecha_creacion_fud": "2019-08-05 18:38:01",
                "longitud": "-65.385023",
                "latitud": "-14.431075",
                "tipo_denuncia": "QUERELLA",
                "fecha_hora_inicio": "1986-02-05 05:54:39",
                "fecha_hora_fin": "1991-01-23 00:37:21",
                "momento_aproximado": "Amet sint similique reiciendis.",
                "etapa_caso": "Abierto",
                "estado_caso": "Preliminar",
                "oficina": null,
                "titulo": null,
                "delito_principal": null
            },
            {
                "codigo_fud": "608431",
                "relato": "Aut non voluptates molestiae aut omnis voluptatum quam placeat et exercitationem dolor non deleniti neque voluptatem incidunt.",
                "resultado": "Mollitia officia impedit nihil.",
                "direccion_caso": "5789 Hettinger Walk\nPort Isabel, AK 63330",
                "detalle_localizacion": "5789 Hettinger Walk\nPort Isabel, AK 63330",
                "provincia": "MUÑECAS",
                "municipio": "AYATA",
                "fecha_creacion_fud": "2019-08-05 18:38:01",
                "longitud": "-65.429668",
                "latitud": "-14.215086",
                "tipo_denuncia": "DE OFICIO",
                "fecha_hora_inicio": "1975-02-08 00:02:47",
                "fecha_hora_fin": "1990-11-25 10:51:44",
                "momento_aproximado": "Molestiae qui impedit sapiente.",
                "etapa_caso": "Abierto",
                "estado_caso": "Preliminar",
                "oficina": null,
                "titulo": null,
                "delito_principal": null
            },
            {
                "codigo_fud": "463870",
                "relato": "Iusto et quisquam possimus voluptatibus dolorem eum aperiam alias quis ea iure corrupti vel corrupti vel facilis illo nostrum accusantium et.",
                "resultado": "Nesciunt consectetur aut reprehenderit.",
                "direccion_caso": "90061 Ara Extension\nTillmanmouth, ID 57483",
                "detalle_localizacion": "90061 Ara Extension\nTillmanmouth, ID 57483",
                "provincia": "JAIME ZUDAÑEZ",
                "municipio": "VILLA MOJOCOYA",
                "fecha_creacion_fud": "2019-08-05 18:38:01",
                "longitud": "-65.703666",
                "latitud": "-13.834202",
                "tipo_denuncia": "DENUNCIA ESCRITA",
                "fecha_hora_inicio": "1987-01-14 16:09:56",
                "fecha_hora_fin": "2006-07-10 23:27:32",
                "momento_aproximado": "Maxime incidunt sunt maxime.",
                "etapa_caso": "Abierto",
                "estado_caso": "Preliminar",
                "oficina": null,
                "titulo": null,
                "delito_principal": null
            },
            {
                "codigo_fud": "603390",
                "relato": "Vel officiis laboriosam est voluptatem sed dicta officiis laborum ad alias et ut dolores dolor.",
                "resultado": "Dicta et deserunt odio.",
                "direccion_caso": "88397 Estrella Valleys\nEast Jermeyhaven, VA 71078",
                "detalle_localizacion": "88397 Estrella Valleys\nEast Jermeyhaven, VA 71078",
                "provincia": "LOAYZA",
                "municipio": "MALLA",
                "fecha_creacion_fud": "2019-08-05 18:38:02",
                "longitud": "-66.479394",
                "latitud": "-13.920695",
                "tipo_denuncia": "DE OFICIO",
                "fecha_hora_inicio": "1982-10-21 04:02:49",
                "fecha_hora_fin": "2014-10-05 18:34:59",
                "momento_aproximado": "Aut praesentium corporis quia.",
                "etapa_caso": "Abierto",
                "estado_caso": "Preliminar",
                "oficina": null,
                "titulo": null,
                "delito_principal": null
            }
        ],
        "links": {
            "first": null,
            "last": null,
            "prev": null,
            "next": null
        },
        "meta": {
            "página_actual": 1,
            "url_primera_pagina": "http://api-dev.fiscalia.gob.bo/api/v2/casos?page=1",
            "desde": 1,
            "ultima_pagina": 58,
            "url_ultima_pagina": "http://api-dev.fiscalia.gob.bo/api/v2/casos?page=58",
            "url_pagina_siguiente": "http://api-dev.fiscalia.gob.bo/api/v2/casos?page=2",
            "path": "http://api-dev.fiscalia.gob.bo/api/v2/casos",
            "por_pagina": 5,
            "purl_pagina_anterior": null,
            "a": 5,
            "total": 287
        }
     }
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
     * @bodyParam codigo_fud string required Código Único de la Denuncia
       @bodyParam tipo_denuncia_id integer required Es un catálogo tipo de denuncia (Ejemplo: Verbal, Escrita, Querella, Acción Directa, De oficio)
       @bodyParam fecha_denuncia date required Fecha de la denuncia o fecha de registro del denuncia(Ejemplo 2019-10-24 15:30:15)
       @bodyParam codigo_oficina integer required Código de la Oficina donde se registró el Hecho (CATÁLOGO DE OFICINAS POLICÍA O MINISTERIO PÚBLICO)
       @bodyParam codigo_municipio string required Código de 6 caracteres que identifica al municipio donde sucedió el hecho
       @bodyParam zona_hecho string required Zona donde sucedió el hecho
       @bodyParam direccion_hecho string required Dirección donde sucedió el hecho
       @bodyParam referencia_hecho string required Referencia donde sucedió el hecho.
       @bodyParam longitud string required Longitud donde fue el hecho para la geolocalización.
       @bodyParam latitud string required Latitud donde fue el hecho para la geolocalización.
       @bodyParam codigo_institucion integer Codigo de la institución que nos envía el POST
       @bodyParam user_id integer required Usuario con la cual se inter opera
       @bodyParam fecha_hora_inicio date required Fecha de la denuncia o fecha de registro del denuncia(Ejemplo 2019-10-24 15:30:15)
       @bodyParam fecha_hora_fin date opcional No obligatorio si se cuenta con fecha exacta, fecha de la denuncia o fecha de registro del denuncia(Ejemplo 2019-10-24 15:30:15)
       @bodyParam aproximado string opcional No obligatorio momento aproximado de cuando se realizó el hecho
       @bodyParam quien_hizo string required Fecha en la que se envio el Certificado REJAF
       @bodyParam que_hizo string required alguna observacion del Certificado REJAF
       @bodyParam aquien_hizo string required estado del Certificado REJAF
       @bodyParam como_hizo string required DOCUMENTO PDF del REJAF
       @bodyParam relato string opcional Descripción del hecho al momento de la denuncia

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
      @response
     *  {
     *  "message" : "se inserto satisfactoriamente",
     *  "code" : 201
     *  }
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo_fud' => 'required|max:250|string',
            'tipo_denuncia_id' => 'required',
            'fecha_denuncia' => 'required|date',
            'codigo_oficina' => 'required|numeric',
            'codigo_municipio' => 'required',
            'zona_hecho' => 'required|max:550|string',
            'direccion_hecho' => 'required|max:550|string',
            'referencia_hecho' => 'required|max:550|string',
            'longitud' => 'required|numeric',
            'latitud' => 'required|numeric',
            'codigo_institucion' => 'required',
            'user_id' => 'required|numeric',
            ]);
        //dd($request->has('fecha_hora_inicio'));
        if ($request->fecha_hora_inicio == '' && $request->fecha_hora_fin=='' && $request->aproximado =='') {
            $datos = $request->validate([
                'fecha_hora_inicio' => 'required|date',
                'fecha_hora_fin' => 'required|date',
                'aproximado' => 'required|string',
            ]);
        }
        switch ($request->tipo_denuncia_id) {
            case 1:
                $datos = $request->validate([
                    'quien_hizo' => 'required|string',
                    'que_hizo' => 'required|string',
                    'aquien_hizo' => 'required|string',
                    'como_hizo' => 'required|string',
                    ]);
                break;

            default:
                $datos = $request->validate([
                    'relato' => 'required|string',
                    ]);
                break;
        }
        if($request->aproximado);

        $municipio = UbgeMunicipio::where('codigo',$request->codigo_municipio)->first();
        if ($municipio == null) {
           return $this->errorResponse('el codigo del municipo no existe',404);
        }
        $hecho = new Hecho();

        $hecho->codigo = $request->codigo_fud;
        $hecho->relato = $request->relato;
        $hecho->resultado = $request->resultado;
        $hecho->circunstancia = $request->circunstancia;
        $hecho->direccion = $request->direccion_hecho;
        $hecho->zona = $request->zona_hecho;
        $hecho->detallelocacion = $request->referencia_hecho;
        $hecho->municipio_id = $municipio->id;
        $hecho->user_id = $request->user_id;
        $hecho->longitude = $request->longitud;
        $hecho->latitude = $request->latitud;
        $hecho->tipo_denuncia_id = $request->tipo_denuncia_id;
        $hecho->fechahorainicio = $request->fecha_hora_inicio;
        $hecho->fechahorafin = $request->fecha_hora_fin;
        $hecho->aproximado = $request->aproximado;
        $hecho->creado_en_institucion_id = $request->codigo_institucion;
        $hecho->oficina_id = $request->codigo_oficina;
        $hecho->titulo = $request->titulo;
        $hecho->quien_hizo = $request->quien_hizo;
        $hecho->que_hizo = $request->que_hizo;
        $hecho->aquien_hizo = $request->aquien_hizo;
        $hecho->como_hizo = $request->como_hizo;
        $hecho->relato_generado = 0;
        $hecho->hecho_estado_id = 1;
        $hecho->hecho_etapa_id = 1;
        $hecho->division_id = 36;

        $hecho->save();
        //Hecho::create($datos);

        return $this->successResponse('se inserto satisfactoriamente', 201);
    }

    /**
     * Metodo GET para obtener un solo caso; se envia el codigo del caso en la URL.
     *
     * <p><b>CASO DE EJEMPLO</b></p>
     * <b>/v2/casos/601102011900007</b>
     *
     *
     * @param  \App\Models\Denuncia\Hecho  $hecho
     * @return \Illuminate\Http\Response
     * @response
     {
        "data": {
            "codigo_fud": "601102011900007",
            "relato": "El 09/10/19 08:10 en TARIJA central colon 200 . <br><br>zcvzxc, <br><br>zxcvzxc, zxcvzx, <br><br>Personas afectadas:  . <br><br>cvzxcvzxcv.",
            "resultado": null,
            "direccion_caso": "colon 200",
            "detalle_localizacion": "colon 200",
            "provincia": "CERCADO",
            "municipio": "TARIJA",
            "fecha_creacion_fud": "2019-10-09 08:11:42",
            "longitud": "-64.7328225",
            "latitud": "-21.5361428",
            "tipo_denuncia": "DENUNCIA VERBAL",
            "fecha_hora_inicio": "2019-10-09 08:10:00",
            "fecha_hora_fin": null,
            "momento_aproximado": null,
            "etapa_caso": "Abierto",
            "estado_caso": "Preliminar",
            "oficina": 275,
            "titulo": "xxxx",
            "delito_principal": null
        }
     }
    */
    public function show($id)
    {

        $caso =  Hecho::where('codigo',$id)->first();
           $transforma = new CasoSujetoResource();
           return $transforma->TranformarCaso($caso);

        /*
        $persona = RrhhPersona::where('n_documento',$id)->first();
        $hecho = HechoPersona::where('persona_id',$persona->id)->select('hecho_id')->get();

        $data = array();

        foreach ($hecho as $key => $value)
        {
           $caso =  Hecho::where('id',$value->hecho_id)->first();
           $transforma = new CasoSujetoResource();
           $data[] = $transforma->TranformarCaso($caso);
        }

       return $data;*/
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
            'codigo_municipio' => 'numeric',
            'zona_hecho' => 'max:550|string',
            'direccion_hecho' => 'max:550|string',
            'referencia_hecho' => 'max:550|string',
            'relato' => 'string',
            'longitud' => 'numeric',
            'latitud' => 'numeric',
            'fecha_hora_inicio' => 'date',
            'fecha_hora_fin' => 'date',
            'aproximado' => 'string',
            'quien_hizo' => 'max:1000|string',
            'que_hizo' => 'max:1000|string',
            'aquien_hizo' => 'max:1000|string',
            'como_hizo' => 'max:1000|string',
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
        if ($request->has('direccion_hecho')) {
            $hecho->direccion = $request->direccion_hecho;
        }
        if ($request->has('zona_hecho')) {
            $hecho->zona = $request->zona_hecho;
        }
        if ($request->has('referencia_hecho')) {
            $hecho->detallelocacion = $request->referencia_hecho;
        }
        if ($request->has('codigo_municipio')) {
            $municipio = UbgeMunicipio::where('codigo',$request->codigo_municipio)->first();
            if ($municipio == null) {
                return $this->errorResponse('el codigo del municipo no existe',404);
            }else
                {
                    $hecho->municipio_id = $municipio->id;
                }
        }
        if ($request->has('longitud')) {
            $hecho->longitude = $request->longitud;
        }
        if ($request->has('latitud')) {
            $hecho->latitude = $request->latitud;
        }
        if ($request->has('tipo_denuncia_id')) {
            $hecho->tipo_denuncia_id = $request->tipo_denuncia_id;
        }
        if ($request->has('fecha_hora_inicio')) {
            $hecho->fechahorainicio = $request->fecha_hora_inicio;
        }
        if ($request->has('fecha_hora_fin')) {
            $hecho->fechahorafin = $request->fecha_hora_fin;
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
