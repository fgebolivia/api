<?php

namespace App\Models\Notificacion;

use Illuminate\Database\Eloquent\Model;

class CasoFuncionario extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'comments';

    protected $table = 'CasoFuncionario';
    protected $fillable = [
        'id',
        'version',
        'FechaAlta',
        'FechaBaja',
        'Notas',
        'Caso',
        'Funcionario',
        'TipoAsignacion'
    ];
    protected $guarded  = [];
}
