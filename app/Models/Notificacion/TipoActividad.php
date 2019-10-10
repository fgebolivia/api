<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'TipoActividad';
    protected $fillable = [
        'id',
        'version',
        'TipoActividad',
        'Activo',
        'CreaEnPreliminar',
        'CreaEnPreparatoria',
        'CreaEnJuicio',
        
    ];
    protected $guarded  = [];
}
