<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Queue\ManuallyFailedException;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
    ];


    public function comunicados() : BelongsTo
    {
        return $this->belongsTo(Comunicado::class);
    }

    public function eventos() : BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }


    public function usuarios() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'grupo_usuario', 'grupo_id', 'usuario_id')
            ->withPivot(['usuario_id', 'grupo_id', 'moderador'])
            ->withTimestamps();
    }



}
