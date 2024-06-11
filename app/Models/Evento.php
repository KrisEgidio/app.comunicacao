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

    public function confirmacoes() : HasMany
    {
        return $this->hasMany(Confirmacao::class);
    }

    public function presencaConfirmada() : bool
    {
        return $this->confirmacoes->where('usuario_id', auth()->user()->id)->count() > 0;
    }

    public function getDia() : string
    {
        return $this->data->format('d');
    }

    public function getMes() : string
    {
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        ];

        return $meses[$this->data->format('m')];
    }

    public function getDiaDaSemana() : string
    {
        $dias = [
            '0' => 'Domingo',
            '1' => 'Segunda-feira',
            '2' => 'Terça-feira',
            '3' => 'Quarta-feira',
            '4' => 'Quinta-feira',
            '5' => 'Sexta-feira',
            '6' => 'Sábado',
        ];

        return $dias[$this->data->format('w')];
    }

    public function getEndereco()
    {
        return "{$this->endereco}, {$this->bairro}, {$this->cidade->nome} - {$this->cidade->estado->sigla}, CEP: {$this->cep}";
    }

    public function getHora() : string
    {
        return substr($this->hora, 0, 5); // Extrai os primeiros 5 caracteres (hh:mm)
    }
}
