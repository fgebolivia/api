<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'Persona';
    protected $fillable = [
        'id',
        'Nombres',
        'ApPat',
        'ApMat',
        'ApEsp',
        'Persona',
        'NumDocId',
        'Caso',
        'DirDom',
        'ZonaDom',
    ];
    protected $guarded  = [];
}
