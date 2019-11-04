<?php

namespace App\Models\I4;

use Illuminate\Database\Eloquent\Model;

class SigcHechoSujetoAbogado extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'sigc_hechos_sujetos_abogados';
    protected $fillable = [
        'id',
        'hecho_sujeto_id',
        'abogado_id',
        'estado',
        'fh_alta',
        'fh_baja',
    ];
    protected $guarded  = [];
}
