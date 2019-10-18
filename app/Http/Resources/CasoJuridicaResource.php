<?php

namespace App\Http\Resources;

use App\Models\Denuncia\GradoDiscapacidad;
use App\Models\Denuncia\GrupoVulnerabilidad;
use App\Models\Denuncia\HechoPersona;
use App\Models\Denuncia\NivelEducacion;
use App\Models\Denuncia\RelacionVictima;
use App\Models\Denuncia\RepresentanteLegal;
use App\Models\Rrhh\RrhhPersona;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\Models\UbicacionGeografica\UbgeProvincia;
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
        
        $complementoHechoPersona = HechoPersona::where('hecho_id',$this->pivot->hecho_id)->where('persona_juridica_id',$this->id)->first();
         $representante = RepresentanteLegal::where('persona_juridica_id', $complementoHechoPersona->persona_juridica_id)->first();
        
         if ($representante== null) {
            $nombre_rep = null;
            $n_documento_rep = null;
            $valida = 0;

        }else{
            $persona = RrhhPersona::where('id',$representante->persona_id)->first();
            $nombre_rep = $persona->nombre.' '.$persona->ap_paterno.' '.$persona->ap_materno;
            $n_documento_rep = $persona->n_documento;
            $valida = $persona->estado_persona;
        }

        if ($municipio== null) {
            $muni = null;
            $provin = null;
        }else{
            $muni = $municipio->nombre;
            $provin= UbgeProvincia::where('id',$municipio->provincia_id)->first()->nombre;
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
            'es_persona_valida'=>$valida,
            'provincia' => $provin,
            'municipio' => $muni,
            'razon_social' => $this->razon_social,
            'nit' => $this->nit,
            'domicilio' => $this->domicilio,
            'telefono' => $this->telefono,
            'relacion_victima' => $relacionVictima,
            'representante_legal' =>[
                'n_documento' => $n_documento_rep,
                'nombre_completo' => $nombre_rep,
            ],
        ];
    }
}
