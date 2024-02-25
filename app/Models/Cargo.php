<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'permissao_id',
    ];

    public function permissao() : BelongsTo
    {
        return $this->belongsTo(Permissao::class);
    }
}
