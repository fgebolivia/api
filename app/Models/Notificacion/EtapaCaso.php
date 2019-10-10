<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class EtapaCaso extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'EtapaCaso';
    protected $fillable = [
        'id',
        'version',
        'EtapaCaso',
        'triton_estado',
        
    ];
    protected $guarded  = [];
}
