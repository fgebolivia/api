<?php

namespace App\Models\Agenda;

use Illuminate\Database\Eloquent\Model;

class AgendaCausal extends Model
{
    protected $table = 'age_tipo_causales';

    protected $fillable = [
        'agenda_id',
        'tipo_causal_id',
        'tipo',        
    ];

    protected $guarded = [];
}
