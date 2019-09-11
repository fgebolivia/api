<?php

namespace App\Http\Resources;

use App\Models\Denuncia\MedidaProteccion;
use Illuminate\Http\Resources\Json\JsonResource;

class MedidaProteccionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $descripcionMedidas = MedidaProteccion::where('id',$this->medidaproteccion_id)->first();
        
       // dd($descripcionMedidas);

        return [
             'medida_proteccion' =>$this->medidaproteccion_id,
             'tipo' =>$descripcionMedidas->tipo,
             'inciso' =>$descripcionMedidas->inciso,
             'descripcion' =>$descripcionMedidas->descripcion
        ];
    }
}
