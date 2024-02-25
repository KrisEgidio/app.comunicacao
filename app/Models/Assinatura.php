<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'valor',
        'data_inicio',
        'data_fim',
        'status',
    ];

    protected $dates = [
        'data_inicio',
        'data_fim',
    ];

    


}
