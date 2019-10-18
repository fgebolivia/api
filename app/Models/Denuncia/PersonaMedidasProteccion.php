<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class PersonaMedidasProteccion extends Model
{
    protected $table = 'hechopersona_medidasproteccion';

    protected $fillable = [
        'estado',
        'hechopersona_id',
		'medidaproteccion_id'
        
    ];

    protected $guarded = [];
}
