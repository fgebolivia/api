<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class EstadoCaso extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'EstadoCaso';
    protected $fillable = [
        'id',
        'version',
        'EstadoCaso',
        
    ];
    protected $guarded  = [];
}
