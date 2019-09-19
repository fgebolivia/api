<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class HechoSujetosAbogados extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'sigc_hechos_sujetos_abogados';
    protected $fillable = [
        'hecho_sujeto_id',
        'abogado_id',
        'estado',
        'fh_alta',
        'fh_baja'
    ];
    protected $guarded  = [];
}
