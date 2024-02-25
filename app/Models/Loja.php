<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Queue\ManuallyFailedException;

class Loja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'endereco',
        'bairro',
        'telefone',
        'cep',
        'cidade_id',
    ];

    protected $casts = [
        'cidade_id' => 'integer',
    ];

    public function cidade() : BelongsTo
    {
        return $this->belongsTo(Cidade::class);
    }

    public function templos() : BelongsToMany
    {
        return $this->belongsToMany(Templo::class, 'loja_templo');
    }

    public function comunicados() : BelongsTo
    {
        return $this->belongsTo(Comunicado::class);
    }

    public function eventos() : BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function compartilhamentos() : BelongsTo
    {
        return $this->belongsTo(Compartilhamento::class);
    }

    public function usuarios() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'loja_usuario');
    }

}
