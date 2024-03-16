<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'hora',
        'data',
        'endereco',
        'bairro',
        'cep',
        'cidade_id',
        'grupo_id',
        'criado_por',
    ];

    protected $casts = [
        'data' => 'date',
        'hora' => 'time',
        'cidade_id' => 'integer',
        'grupo_id' => 'integer',
        'criado_por' => 'integer',
    ];

    public function cidade() : BelongsTo
    {
        return $this->belongsTo(Cidade::class);
    }

    public function grupo() : BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }

    public function criadoPor() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function imagem() : MorphMany
    {
        return $this->morphMany(Imagem::class, 'model');
    }

    public function confirmacoes() : MorphMany
    {
        return $this->morphMany(Confirmacao::class, 'model');
    }
}
