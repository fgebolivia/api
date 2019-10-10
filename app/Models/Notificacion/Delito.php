<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class Delito extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'Delito';
    protected $fillable = [
        'id',
        'version',
        'Libro',
        'Titulo',
        'Capitulo',
        'Num',
        'Articulo',
        'Inciso',
        'Delito',
        'Activo',
        'PenaMinima',
        'PenaMaxima',
        
    ];
    protected $guarded  = [];
}
