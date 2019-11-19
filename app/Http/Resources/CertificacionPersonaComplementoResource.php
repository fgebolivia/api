<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CertificacionPersonaComplementoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   //dd($request);

            $documento = explode("-", $this->n_documento);

        return [
            'n_documento'       => $documento[0],
            'complemento'       => $documento[1],
            'nombre'            => $this->nombre,
            'ap_paterno'        => $this->ap_paterno,
            'ap_materno'        => $this->ap_materno,
            'ap_esposo'         => $this->ap_esposo,
            'sexo'              => $this->sexo,
            'fecha_nacimiento'  => $this->f_nacimiento,
            'domicilio'         => $this->domicilio,
            'telefono'          => $this->telefono,
            'celular'           => $this->celular,
            'url'               => $this->certificacion_file_segip,
            'ciudadano_digital' => $this->es_ciudadano_digital,
        ];
    }
}
