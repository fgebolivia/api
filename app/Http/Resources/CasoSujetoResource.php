<?php

namespace App\Http\Resources;

use App\Models\Denuncia\Felonys;
use App\Models\Denuncia\HechoEstado;
use App\Models\Denuncia\HechoEtapa;
use App\Models\Denuncia\HechoFelony;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\PolDivision;
use App\Models\Denuncia\PolOficina;
use App\Models\Denuncia\TipoDenuncia;
use App\Models\Notificacion\Actividad;
use App\Models\Notificacion\Caso;
use App\Models\Notificacion\CasoDelito;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\Models\UbicacionGeografica\UbgeProvincia;
use Illuminate\Http\Resources\Json\JsonResource;

class CasoSujetoResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function TranformarCaso($caso)
    {
        $Denuncia  = TipoDenuncia::where('id',$caso->tipo_denuncia_id)->first();

        $estado    = HechoEtapa::where('id',$caso->hecho_estado_id)->first();
        if ($estado)
        {
            $estadoNombre = $estado->nombre;
        }
        else
        {
            $estadoNombre = null;
        }

        $etapa     =  HechoEstado::where('id',$caso->hecho_etapa_id)->first();
        if ($etapa)
        {
            $etapaNombre = $etapa->nombre;
        }
        else
        {
            $etapaNombre = null;
        }

        $oficina = PolOficina::where('id',$caso->oficina_id)->first();
        if ($oficina)
        {
            $oficinaNombre = $oficina->nombre;
        }
        else
        {
            $oficinaNombre = null;
        }

        $division = PolDivision::where('id',$caso->division_id)->first();
        if ($oficina)
        {
            $divisionNombre = $division->nombre;
        }
        else
        {
            $divisionNombre = null;
        }

        $casoi4 = Caso::where('id',$caso->i4_caso_id)->first();

        if ($casoi4)
        {
            $delitoPrin = $casoi4->DelitoPrincipal;
        }

        $deli = CasoDelito::where('Caso',$casoi4->id)->get();
        foreach ($deli as $key) {
            $delitos[] =[
                'codigo_delito'=> $key->Delito,
            ];
        }

        $activi = Actividad::where('Caso',$casoi4->id)->get();
        foreach ($activi as $key) {
            $actividades[] =[
                'nombre_actividad' => $key->Actividad,
                'tipo_actividad'   => $key->TipoActividad,
                'fecha_actividad'  => $key->fh_actividad,
                'url_descarga'     => 'https://triton-dev.fiscalia.gob.bo/',
            ];
        }

        $suje = HechoPersona::where('hecho_id',$caso->id)->get();
        foreach ($suje as $key) {
            $sujetos[] =[
                'id'                 => $key->id,
                'id_i4'              => $key->i4_persona_id,
                'nombre_completo'    => $key->busqueda_nombre,
                'ci'                 => $key->busqueda_ci,
                'fecha_nacimiento'   => null,
                'idioma'             => 'español',
                'estado_procesal_id' => $key->estado_libertad_id,
                'es_victima'         => $key->es_victima,
                'tipo_sujeto_id'     => $key->tipo_sujeto_id
            ];
        }

        return [
            'codigo_fud'         => $caso->codigo,
            'url_descarga_FUD'   => 'https://triton-dev.fiscalia.gob.bo/',
            'fecha_creacion_fud' => (string)$caso->fecha_creacion_denuncia,
            'tipo_denuncia'      => $Denuncia->nombre,
            'fecha_hora_inicio'  => $caso->fechahorainicio,
            'fecha_hora_fin'     => $caso->fechahorafin,
            'momento_aproximado' => $caso->aproximado,
            'etapa_caso'         => $etapaNombre,
            'estado_caso'        => $estadoNombre,
            'delito_Principal'   => $delitoPrin,
            'division'           => $divisionNombre,
            'oficina'            => $oficinaNombre,
            'juzgado'            => $caso->jusgado_id,
            'titulo'             => $caso->titulo,
            'actividades'        => $actividades,
            'delitos'            => $delitos,
            'sujetos_procesales' => $sujetos

        ];
    }
}
