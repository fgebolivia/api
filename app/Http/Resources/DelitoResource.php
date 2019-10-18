<?php

namespace App\Http\Resources;


use App\Models\Denuncia\Felonys;
use App\Models\Denuncia\HechoFelony;
use Illuminate\Http\Resources\Json\JsonResource;

class DelitoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $delito = HechoFelony::where('polhecho_id',$this->id)->where('principal', 1)->first();
        //dd($delito);
        $felonys = Felonys::where('id',$delito->felony_id)->first();

        return [
            'codigo_fud' => $this->codigo,
            'delito_principal'=> [
                    'libro'=> $felonys->libro,
                    'titulo'=> $felonys->titulo,
                    'capitulo'=> $felonys->capitulo,
                    'numero'=> $felonys->numero,
                    'articulo'=> $felonys->articulo,
                    'inciso'=> $felonys->inciso,
                    'clase_delito' => $felonys->clase_delito,
                    'delito' => $felonys->delito,
                    'materia' => $felonys->materia,
                    'pena_minima' => $felonys->pena_minima,
                    'pena_maxima' => $felonys->pena_maxima

            ],
            'notas' => $delito->notas,
        ];
    }
}
