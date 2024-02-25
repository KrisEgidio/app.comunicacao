<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LojaTemplo extends Model
{
    use HasFactory;

    protected $table = 'loja_templo';

    protected $fillable = [
        'loja_id',
        'templo_id',
    ];

    protected $casts = [
        'loja_id' => 'integer',
        'templo_id' => 'integer',
    ];

    public function loja() : BelongsTo
    {
        return $this->belongsTo(Loja::class);
    }

    public function templo() : BelongsTo
    {
        return $this->belongsTo(Templo::class);
    }
}
