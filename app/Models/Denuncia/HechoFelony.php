<?php

namespace App\Models\Denuncia;

use Illuminate\Database\Eloquent\Model;

class HechoFelony extends Model
{
    protected $table = 'polhecho_felony';

    protected $fillable = [
        'principal',
        'tentativa',
        'notas',
        'polhecho_id',
        'felony_id'
    ];

    protected $guarded = [];
}
