<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'Caso';
    protected $fillable = [
        'Caso',
        'CodCasojuz',
        'Titulo',
        'VencimientoCaso',
        'NivelReserva',
        'FechaHecho',
        'HoraHecho',
        'FechaDenuncia',
        'Dir',
        'BreveDescripcionHecho',
        'EstadoCaso',
        'EtapaCaso',
        'OrigenCaso',
        'DelitoPrincipal',
    ];
    protected $guarded  = [];
}
