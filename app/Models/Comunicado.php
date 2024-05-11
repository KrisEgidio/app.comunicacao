<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comunicado extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data',
        'hora',
        'grupo_id',
        'criado_por',
    ];

    protected $casts = [
        'data' => 'date',
        'grupo_id' => 'integer',
        'criado_por' => 'integer',
    ];


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
}
