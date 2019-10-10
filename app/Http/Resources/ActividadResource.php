<?php

namespace App\Http\Resources;

use App\Models\Denuncia\TipoDenuncia;
use App\Models\Notificacion\Actividad;
use App\Models\Notificacion\Delito;
use App\Models\Notificacion\EstadoCaso;
use App\Models\Notificacion\EtapaCaso;
use App\Models\Notificacion\OrigenCaso;
use App\Models\UbicacionGeografica\UbgeMunicipio;
use App\Models\UbicacionGeografica\UbgeProvincia;
use Illuminate\Http\Resources\Json\JsonResource;

class ActividadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $origenCaso = OrigenCaso::where('id',$this->OrigenCaso)->first();

        $etapaCaso = EtapaCaso::where('id',$this->EtapaCaso)->first();

        $estadoCaso =  EstadoCaso::where('id',$this->EstadoCaso)->first();

        $delitoPrincipal = Delito::where('id',$this->DelitoPrincipal)->first();

        $actividad = Actividad::where('Caso',$this->id)->whereIn('TipoActividad', [16,26,271])->get();
        //dd($actividad);
         foreach ($actividad as $key => $value) {
            $actividades[] = [
                'tipo_actividad' => $value->TipoActividad,
                'descripcion_actividad' => $value->Actividad,
                'documento' => $value->Documento,
                'pdf' => '',
                ];
        }
        return [
            'codigo_fud' => $this->Caso,
            'titulo' => $this->Titulo,
            'analisis' => $this->Analisis,
            'fecha_denuncia' => $this->FechaDenuncia,
            'origen_caso' => $origenCaso->OrigenCaso,
            'etapa_caso' => $etapaCaso->EtapaCaso,
            'estado_caso' => $estadoCaso->EstadoCaso,
            'delito_principal' => [
                        'libro' => $delitoPrincipal->Libro,
                        'titulo' => $delitoPrincipal->Titulo,
                        'capitulo' => $delitoPrincipal->Capitulo,
                        'numero' => $delitoPrincipal->Num,
                        'articulo' => $delitoPrincipal->Articulo,
                        'inciso' => $delitoPrincipal->Inciso,
                        'delito' => $delitoPrincipal->Delito,
            ],
            'Actividades' => $actividades,
        ];
    }
}
