<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CasoJuridicaResource extends JsonResource
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

        return [
            'provincia' => $provincia->nombre,
            'municipio' => $municipio->nombre,
            'razon_social' => $this->razon_social,
            'nit' => $this->nit,
            'domicilio' => $this->domicilio,
            'telefono' => $this->telefono,
        ];
    }
}
