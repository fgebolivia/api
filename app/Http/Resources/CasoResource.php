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
        $estado =  HechoEtapa::where('id',$this->hecho_estado_id)->first();
        $etapa =  HechoEstado::where('id',$this->hecho_etapa_id)->first();
        $delito = HechoFelony::where('polhecho_id',$this->id)->where('principal', 1)->first();
        if ($delito === null) {
            $delitoPrincipal = null;
        }else{
            $felonys = Felonys::where('id',$delito->felony_id)->first();
            $delitoPrincipal = [
                    'libro'=> $felonys->libro,
                    'titulo'=> $felonys->titulo,
                    'capitulo'=> $felonys->capitulo,
                    'numero'=> $felonys->numero,
                    'articulo'=> $felonys->articulo,
                    'inciso'=> $felonys->inciso,
                    'clase_delito' => $felonys->clase_delito,
                    'descripcion_delito' => $felonys->delito,
                    'materia' => $felonys->materia,
                    'pena_minima' => $felonys->pena_minima,
                    'pena_maxima' => $felonys->pena_maxima
            ];
        }

        return [
            'codigo_fud' => $this->codigo,
            'relato' => $this->relato,
            'resultado' => $this->conducta,
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
            'etapa_caso' => $etapa->nombre,
            'estado_caso' =>$estado->nombre,
            'oficina' => $this->oficina_id,
            'titulo' => $this->titulo,
            'delito_principal' => $delitoPrincipal,

        ];
    }
}
