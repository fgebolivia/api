<?php

namespace App\Http\Resources;

use App\Models\Agenda\Agenda;
use App\Models\Agenda\Juzgado;
use App\Models\Agenda\TipoAudiencia;

class AgendasResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function tranformarAgenda($agendaPersona, $fech_del, $fech_al)
    {
        $agenda = Agenda::where('id',$agendaPersona->agenda_id)->whereBetween('fecha_hora_inicio', [$fech_del, $fech_al])->first();
        //dd($agenda);
        if (!$agenda) {
            return null;
        }
        $juzgado = Juzgado::where('id',$agenda->juzgado_id)->first();
        $tipoAudiencia = TipoAudiencia::where('id',$agenda->tipo_audiencia_id)->first();

        return[
                'agenda_id'          => $agenda->id,
                'codigo_cud'         => $agenda->codigo_unico,
                'fecha_inicio'       => $agenda->fecha_hora_inicio,
                'fecha_fin'          => $agenda->fecha_hora_fin,
                'estado'             => $juzgado->estado,
                'descripcion'          => 'Audiencia '.$tipoAudiencia->nombre.'<br>'.$juzgado->nombre.'<br>'.$juzgado->direccion,
                'ubicacion_latitud'    => $juzgado->map_latitud,
                'ubicacion_longitud'   => $juzgado->map_longitud
            ];
    }
}
