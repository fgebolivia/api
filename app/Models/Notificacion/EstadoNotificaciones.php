<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class EstadoNotificaciones extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'sigc_estado_notificaciones';
    protected $fillable = [
        'estado',
        'orden',
        'nombre',
    ];
    protected $guarded  = [];
}
