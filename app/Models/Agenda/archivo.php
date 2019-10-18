<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class archivo extends Model
{
    protected $table = 'age_archivos';

    protected $fillable = [
        'archivo',
        'agendamiento_id',
        'causal_suspencion_id'
    ];

    protected $guarded = [];
}
