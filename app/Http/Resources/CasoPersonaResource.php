<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CasoPersonaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $municipioNacido = UbgeMunicipio::where('id',$this->municipio_id_nacimiento)->first();
        $municipioResidencia = UbgeMunicipio::where('id',$this->municipio_id_residencia)->first();
        $provinciaNacido = UbgeProvincia::where('id',$municipioNacido->provincia_id)->first();
        $provinciaResidencia = UbgeProvincia::where('id',$municipioResidencia->provincia_id)->first();

        return [
            'provincia_nacimiento' => $provinciaNacido->nombre,
            'municipio_nacimiento' => $municipioNacido->nombre,
            'provincia_residencia' => $provinciaResidencia->nombre,
            'municipio_residencia' => $municipioResidencia->nombre,
            'n_documento' => $this->n_documento,
            'nombre' => $this->nombre,
            'ap_paterno' => $this->ap_paterno,
            'ap_materno' => $this->ap_materno,
            'ap_esposo' => $this->ap_esposo,
            'sexo' => $this->sexo,
            'f_nacimiento' => $this->f_nacimiento,
            'estado_civil' => $this->estado_civil,
            'domicilio' => $this->domicilio,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'created_at' => $this->created_at,
            'profesion_ocupacion' => $this->profesion_ocupacion,
            'pueblo_originario' => $this->pueblo_originario,
            'lugar_trabajo' => $this->lugar_trabajo,
            'domicilio_laboral' => $this->domicilio_laboral,
            'telf_laboral' => $this->telf_laboral,
            'alias' => $this->alias,
            'estatura' => $this->estatura,
            'tez' => $this->tez,
            'edad' => $this->edad,
            'vestimenta' => $this->vestimenta,
            'senia' => $this->senia,
            'peso' => $this->peso,
            'cabello' => $this->cabello,
            'genero' => $this->genero,
            'email' => $this->email,
            'ojos' => $this->ojos,
            'es_ciudadano_digital' => $this->es_ciudadano_digital,

        ];
    }
}
