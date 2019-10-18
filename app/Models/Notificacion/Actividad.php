<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'Actividad';
    protected $fillable = [
        'id',
        'version',
        'Fecha',
        'Actividad',
        'informe',
        'AllanamientoPositivo',
        'RequisaPositiva',
        'Documento',
        '_Documento',
    ];
    protected $guarded  = [];
}
