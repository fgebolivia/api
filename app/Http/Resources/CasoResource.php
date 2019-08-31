<?php

namespace App\Http\Resources;

use App\Models\Denuncia\TipoDenuncia;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\Models\UbicacionGeografica\UbgeProvincia;
use Illuminate\Http\Resources\Json\JsonResource;

class CasoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $municipio = UbgeMunicipio::where('id',$this->municipio_id)->first();
        $provincia = UbgeProvincia::where('id',$municipio->provincia_id)->first();
        $Denuncia =  TipoDenuncia::where('id',$this->tipo_denuncia_id)->first();

        return [
            'codigo_fud' => $this->codigo,
            'relato' => $this->relato,
            'conducta' => $this->conducta,
            'resultado' => $this->conducta,
            'circunstancia' => $this->circunstancia,
            'direccion_caso' => $this->direccion,
            'detalle_localizacion' => $this->direccion,
            'provincia' => $provincia->nombre,
            'municipio' => $municipio->nombre,
            'fecha_creacion_fud' => (string)$this->created_at,
            'longitud' => $this->longitude,
            'latitud' => $this->latitude,
            'tipo_denuncia' => $Denuncia->nombre,
            'fecha_hora_inicio' => $this->fechahorainicio,
            'fecha_hora_fin' => $this->fechahorafin,
            'momento_aproximado' => $this->aproximado,
            'oficina' => $this->oficina_id,
            'titulo' => $this->titulo,

        ];
    }
}
