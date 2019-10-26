<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'Funcionario';
    protected $fillable = [
        'id',
        'Division',
        'Nombres',
        'ApPat',
        'ApMat',
        'ApEsp',
        'NumDocId',
    ];
    protected $guarded  = [];
}
