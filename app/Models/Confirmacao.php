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
        'model_type',
        'model_id',
        'token',
        'confirmado_em',
        'enviado_em',
        'expira_em',
        'usuario_id',
    ];

    protected $casts = [
        'model_id' => 'integer',
        'usuario_id' => 'integer',
        'confirmado_em' => 'datetime',
        'enviado_em' => 'datetime',
        'expira_em' => 'datetime',
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function usuario() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
