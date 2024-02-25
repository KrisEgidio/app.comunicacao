<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compartilhamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'aceito',
        'data_aceite',
        'compartilhado_por',
        'aceito_por',
        'evento_id',
        'loja_id',
    ];

    protected $casts = [
        'aceito' => 'boolean',
        'data_aceite' => 'datetime',
        'compartilhado_por' => 'integer',
        'aceito_por' => 'integer',
    ];

    public function compartilhadoPor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'compartilhado_por');
    }

    public function aceitoPor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'aceito_por');
    }

    public function evento() : BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function loja() : BelongsTo
    {
        return $this->belongsTo(Loja::class);
    }
}
