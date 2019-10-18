<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class OrigenCaso extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'OrigenCaso';
    protected $fillable = [
        'id',
        'version',
        'OrigenCaso',
        
    ];
    protected $guarded  = [];
}
