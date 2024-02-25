<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Templo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'endereco',
        'bairro',
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

    public function lojas() : BelongsToMany
    {
        return $this->belongsToMany(Loja::class, 'loja_templo');
    }
}
