<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class DocumentosAprobados extends Model
{
    protected $connection = 'comments';
    protected $table = 'jl1_documentos_aprobados_cd';

    protected $fillable = [
        'persona_triton_id',
        'documento_valido',
        'objeto_tipo',
        'objeto_hash',
        'tramite_uuid',
        'codigo_operacion',
        'transaccion_id',
        'fh_solicitud',
        'fh_solicitud_agetic',
        'fh_respuesta',        
    ];

    protected $guarded = [];
}
