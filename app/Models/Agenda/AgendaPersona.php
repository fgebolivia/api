<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class AgendaPersona extends Model
{
    protected $table = 'age_agenda_persona';

    protected $fillable = [
        'agenda_id',
        'persona_id',
        'tipo',        
    ];

    protected $guarded = [];
}
