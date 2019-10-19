<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class CasoDelito extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'zCasoDelitoDup2';
    protected $fillable = [
        'nro_fila',
        'idCasoDelito',
        'Caso',
        'Delito',        
    ];
    protected $guarded  = [];
}
