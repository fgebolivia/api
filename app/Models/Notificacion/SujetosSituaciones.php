<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class SujetosSituaciones extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'sigc_sujetos_situaciones';
    protected $fillable = [
        'estado',
        'orden',
        'nombre',
    ];
    protected $guarded  = [];
}
