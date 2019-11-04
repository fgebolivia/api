<?php

namespace App\Models\I4;

use Illuminate\Database\Eloquent\Model;

class SigcAbogado extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'sigc_abogados';
    protected $fillable = [
        'triton_persona_id',
        'rpa_persona_id',
        'estado',
        'n_documento',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'f_nacimiento',
        'nombre_completo',
        'matricula',
        'f_registro',
        'es_ciudadano_digital',
        'certificacion_file_segip',
        'estado_registro',
        'foto_direccion',
        'f_vencimiento_matricula',
    ];
    protected $guarded  = [];
}
