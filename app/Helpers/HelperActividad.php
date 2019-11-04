<?php

namespace App\Helpers;

use App\Models\Notificacion\Actividad;
use App\Models\Notificacion\Calendario;
use App\Models\Notificacion\Funcionario;


class HelperActividad
{

    public static function createActividad($valor)
    {
        $f_actual  = date("Y-m-d");

        $ip        = \Request::ip();//afuera

        //$consulta1 = Funcionario::where("id", "=", $valor['i4_funcionario_id'])
        //                ->select("Funcionario", "UserId")
        //                ->first();

        $consulta2 = Calendario::where("Calendario", "=", $f_actual)
                        ->select("id")
                        ->first();

        $iu                = new Actividad;
        $iu->Caso          = $valor['caso_id'];
        $iu->TipoActividad = $valor['tipo_actividad_id'];
        $iu->Actividad     = $valor['actividad'];

        $iu->version              = 1;
        $iu->Fecha                = $f_actual;
        $iu->AllanamientoPositivo = 0;
        $iu->RequisaPositiva      = 0;

        //$iu->Documento      = $valor['documento'];
        $iu->_Documento     = $valor['documento_nombre'];
        $iu->nombre         = $valor['documento_nombre'];
        $iu->nombre_archivo = $valor['nombre_archivo'];
        $iu->extension      = $valor['extension'];

        //$iu->CreatorUser                  = $consulta1["UserId"];
        //$iu->CreatorFullName              = strtoupper($consulta1["Funcionario"]);
        $iu->CreationDate                 = $valor['fh_actual'];
        $iu->CreationIP                   = $ip;
        //$iu->UpdaterUser                  = $consulta1["UserId"];
        $iu->recibido_por                 = 1;
        $iu->UpdaterDate                  = $valor['fh_actual'];
        $iu->UpdaterIP                    = $ip;
        $iu->EstadoDocumento              = 2;
        $iu->CalFecha                     = $consulta2["id"];
        //$iu->Asignado                     = $valor['i4_funcionario_id'];
        $iu->FechaIni                     = $f_actual;
        $iu->FechaFin                     = $f_actual;
        $iu->fh_actividad                 = $valor['fh_actual'];
        $iu->estado_triton                = 1;
        $iu->ActividadActualizaEstadoCaso = 0;

        $iu->timestamps = false;

        $iu->save();

       return $iu->id;
    }

    public static function updateActividadDocumentoPdf($valor)
    {
        $fh_actual = date("Y-m-d H:i:s");
        $ip        = \Request::ip();

        $consulta1 = Funcionario::where("id", "=", $valor['i4_funcionario_id'])
                        ->select("Funcionario", "UserId")
                        ->first();

        $iu = Actividad::find($valor['id']);

        $iu->version         = $iu->version + 1;
        $iu->Documento       = $valor['documento'];
        $iu->_Documento      = $valor['documento_nombre'];
        $iu->UpdaterUser     = $consulta1["UserId"];
        $iu->UpdaterFullName = strtoupper($consulta1["Funcionario"]);
        $iu->UpdaterDate     = $fh_actual;
        $iu->UpdaterIP       = $ip;

        $iu->timestamps = false;

        $iu->save();
    }

    public static function deleteActividad($valor)
    {
        $de = Actividad::find($valor);
        $de->delete();
    }
}
