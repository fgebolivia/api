<?php
namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

//Model
class HechoJuzgado extends Model
{
    protected $table = 'pol_hecho_juzgado';

    protected $fillable = [
        'id',
        'hecho_id',
        'juzgado_id',
        'estado',
        'motivo',
        'fecha_alta',
        'fecha_baja'
    ];
    protected $guarded = [];

}
