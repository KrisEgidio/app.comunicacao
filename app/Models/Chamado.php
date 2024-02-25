<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'usuario_id',
        'imagem_id',
    ];

    protected $casts = [
        'usuario_id' => 'integer',
        'imagem_id' => 'integer',
    ];

    public function usuario() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function imagem() : MorphMany
    {
        return $this->morphMany(Imagem::class, 'model');
    }

    public function mensagens() : HasMany
    {
        return $this->hasMany(Mensagem::class);
    }
}
