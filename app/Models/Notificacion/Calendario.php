<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'Calendario';
    protected $fillable = [
        'id',
        'version',
        'Calendario',
        'FechaAtomica',
        'Anio',
        'Mes',
        'Dia',
    ];
    protected $guarded  = [];
}
