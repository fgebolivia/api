<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class AgendaCausal extends Model
{
    protected $table = 'age_agenda_causal';

    protected $fillable = [
        'agenda_id',
        'tipo_causal_id',
        'descripcion',        
    ];

    protected $guarded = [];
}
