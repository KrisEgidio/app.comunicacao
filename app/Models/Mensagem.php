<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Mensagem extends Model
{

    protected $table = 'mensagens';

    use HasFactory;

    protected $fillable = [
        'mensagem',
        'usuario_id',
        'chamado_id',
        'imagem_id'
    ];

    protected $casts = [
        'usuario_id' => 'integer',
        'chamado_id' => 'integer',
        'imagem_id' => 'integer'
    ];

    public function usuario() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chamado() : BelongsTo
    {
        return $this->belongsTo(Chamado::class);
    }

    public function imagem() : MorphMany
    {
        return $this->morphMany(Imagem::class, 'model');
    }
}
