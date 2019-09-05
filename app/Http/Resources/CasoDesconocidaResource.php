<?php

namespace App\Http\Resources;

use App\Models\Denuncia\GradoDiscapacidad;
use App\Models\Denuncia\GrupoVulnerabilidad;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\NivelEducacion;
use App\Models\Denuncia\RelacionVictima;
use App\Models\UbicacionGeografica\UbgePais;
use Illuminate\Http\Resources\Json\JsonResource;

class CasoDesconocidaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pais = UbgePais::where('id',$this->pais_id)->first();
        
        $complementoHechoPersona = HechoPersona::where('hecho_id',$this->pivot->hecho_id)->where('persona_desconocida_id',$this->id)->first();

         if ($pais== null) {
            $pa = null;
        }else{
            $pa = $pais->nombre;
        }

        if ($complementoHechoPersona->relacion_victima_id == null) {
            $relacionVictima = null;
        }else{
            $relacionVictima = RelacionVictima::where('id',$complementoHechoPersona->relacion_victima_id)->first()->nombre;
        }
        if ($complementoHechoPersona->nivel_educacion_id == null) {
            $nivelEducacion = null;
        }else{
            $nivelEducacion = NivelEducacion::where('id',$complementoHechoPersona->nivel_educacion_id)->first()->nombre;
        }
        if ($complementoHechoPersona->grupo_vulnerable_id == null) {
            $grupoVulnerable = null;
        }else{
            $grupoVulnerable = GrupoVulnerabilidad::where('id',$complementoHechoPersona->grupo_vulnerable_id)->first()->nombre;
        }
        if ($complementoHechoPersona->grado_discapacidad_id == null) {
            $Discapacidad = null;
        }else{
            $Discapacidad = GradoDiscapacidad::where('id',$complementoHechoPersona->grado_discapacidad_id)->first()->nombre;
        }

        return [
            'es_persona'=>2,
            'pais' => $pa,
            'nombre' => $this->nombre,
            'ap_paterno' => $this->ap_paterno,
            'ap_materno' => $this->ap_materno,
            'descripcion' => $this->descripcion,
            'relacion_victima' => $relacionVictima,
            'nivel_educacion' => $nivelEducacion,
            'grupo_vulnerable' => $grupoVulnerable,
            'grado_discapacidad' => $Discapacidad,
            'estado_procesal' => null,
        ];
    }
}
