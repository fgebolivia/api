<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'sigc_notificaciones';
    protected $fillable = [
        'hecho_id',//este
        'actividad_solicitante_id',//este
        'actividad_notificacion_id',//este
        'funcionario_solicitante_id',//este
        'funcionario_notificador_id',
        'funcionario_reparto_id',
        'tipo_notificacion_id',
        'estado_notificacion_id',
        'sujeto_situacion_id',
        'estado',
        'codigo',// este return
        'solicitud_fh',//este
        'solicitud_asunto',
        'persona_hecho_suejeto_id',//este
        'persona_hecho_sujeto_abogado_id',//este
        'persona_natural_juridica',
        'persona_es_abogado',
        'persona_es_ciudadano_digital',
        'persona_n_documento',//este
        'persona_nombre_completo',//este
        'persona_municipio_id',
        'persona_zona',
        'persona_direccion',
        'persona_telefono',
        'persona_celular',
        'persona_email',
        'persona_map_latitud',
        'persona_map_longitud',
        'notificacion_fh',//este
        'notificacion_ciudadania_digital',
        'notificacion_ciudadania_digital_fh',//este
        'notificacion_publicacion_estado',
        'notificacion_pdf_estado',
        'notificacion_pdf_nombre',//este
        'notificacion_pdf',//este
        'notificacion_oficina_id',//este
        'testigo_persona_id'
    ];
    protected $guarded  = [];
}
