<?php

namespace App\Http\Resources;

use App\Models\Denuncia\Felonys;
use App\Models\Denuncia\HechoEstado;
use App\Models\Denuncia\HechoEtapa;
use App\Models\Denuncia\HechoFelony;
use App\Models\Denuncia\TipoDenuncia;
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
        $municipio = UbgeMunicipio::where('id',$caso->municipio_id)->first();
        $provincia = UbgeProvincia::where('id',$municipio->provincia_id)->first();
        $Denuncia  =  TipoDenuncia::where('id',$caso->tipo_denuncia_id)->first();
        $estado    =  HechoEtapa::where('id',$caso->hecho_estado_id)->first();
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
            $eetapaNombre = null;
        }

        return [
            'codigo_fud'           => $caso->codigo,
            'relato'               => $caso->relato,
            'resultado'            => $caso->conducta,
            'direccion_caso'       => $caso->direccion,
            'detalle_localizacion' => $caso->direccion,
            'provincia'            => $provincia->nombre,
            'municipio'            => $municipio->nombre,
            'fecha_creacion_fud'   => (string)$caso->fecha_creacion_denuncia,
            'longitud'             => $caso->longitude,
            'latitud'              => $caso->latitude,
            'tipo_denuncia'        => $Denuncia->nombre,
            'fecha_hora_inicio'    => $caso->fechahorainicio,
            'fecha_hora_fin'       => $caso->fechahorafin,
            'momento_aproximado'   => $caso->aproximado,
            'etapa_caso'           => $etapaNombre,
            'estado_caso'          => $estadoNombre,
            'oficina'              => $caso->oficina_id,
            'titulo'               => $caso->titulo
        ];
    }
}
