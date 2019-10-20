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

    protected $table = 'CasoDelito';
    protected $fillable = [
        'id',
        'Caso',
        'Delito',        
    ];
    protected $guarded  = [];
}
