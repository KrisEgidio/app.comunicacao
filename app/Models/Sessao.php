<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Sessao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'data',
        'hora',
        'tipo',
        'ordem_do_dia',
        'loja_templo_id',
    ];

    protected $casts = [
        'loja_templo_id' => 'integer',
    ];

    public function lojaTemplo() : BelongsTo
    {
        return $this->belongsTo(LojaTemplo::class);
    }

    public function confirmacoes() : MorphMany
    {
        return $this->morphMany(Confirmacao::class, 'model');
    }

}
