<?php

namespace App\Http\Resources;

use App\Models\Agenda\Agenda;
use App\Models\Agenda\Juzgado;
use App\Models\Denuncia\HechoPersona;

class AgendasCasoResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function  tranformarAgenda($agenda_id)
    {
        $agenda = Agenda::where('id',$agenda_id)->first();
        $juzgado = Juzgado::where('id',$agenda->juzgado_id)->first();
        $sujetosProcesales = HechoPersona::where('hecho_id',$agenda->hecho_id)->where('deleted',0)->get();

        $sujetos = array();
        foreach ($sujetosProcesales as $key)
        {
            $sujetos[] = [
                'nombre'             => $key->busqueda_nombre,
                'tipo_sujeto'        => $key->tipo_sujeto_id,
                'es_victima'         => $key->es_victima,
                'estado_libertad_id' => $key->estado_libertad_id
            ];
        };

    return[
            'codigo_cud'         => $agenda->codigo_unico,
            'fecha_inicio'       => $agenda->fecha_hora_inicio,
            'fecha_fin'          => $agenda->fecha_hora_fin,
            'juzgado'            => $juzgado->nombre,
            'sala'               => $juzgado->nombre,
            'latitud_juzgado'    => $juzgado->map_latitud,
            'longitud_juzgado'   => $juzgado->map_longitud,
            'direccion'          => $juzgado->direccion,
            'tipo_audiencia'     => $agenda->tipo_audiencia_id,
            'sujetos_procesales' => $sujetos
        ];
    }
}
