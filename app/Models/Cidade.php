<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'ibge', 'estado_id'];

    public function estado() : BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }

    public function comunicados() : HasMany
    {
        return $this->hasMany(Comunicado::class);
    }

    public function eventos() : HasMany
    {
        return $this->hasMany(Evento::class);
    }

}
