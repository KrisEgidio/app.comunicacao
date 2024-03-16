<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Confirmacao extends Model
{
    use HasFactory;

    protected $table = 'confirmacoes';

    protected $fillable = [
        'token',
        'confirmado_em',
        'usuario_id',
        'evento_id',
    ];

    protected $casts = [
        'usuario_id' => 'integer',
        'confirmado_em' => 'datetime',
        'evento_id' => 'integer',
    ];

    public function usuario() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function evento() : BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }
}
