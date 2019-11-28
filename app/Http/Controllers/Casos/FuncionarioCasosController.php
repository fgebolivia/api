<?php

namespace App\Http\Controllers\Casos;

use App\Http\Controllers\Controller;
use App\Http\Resources\CasoSujetoResource;
use App\Models\Denuncia\Hecho;
use App\Models\Notificacion\Caso;
use App\Models\Notificacion\CasoFuncionario;
use Illuminate\Http\Request;

class FuncionarioCasosController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //\Log::warning(env('COMMENTS_USERNAME'));
        //$hecho = Caso::where('Caso',$id)->first();
        //dd($hecho);
        $funci = CasoFuncionario::where('Funcionario',$id)->select('Caso')->get();

        $data = array ();
        foreach ($funci as $key)
        {
            $caso = Hecho::where('i4_caso_id',$key->Caso)->first();
            if ($caso) {
                $transforma = new CasoSujetoResource();
                $data[] = $transforma->TranformarCaso($caso);
            }
        }
        return  $data;
    }
}
