<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'degree',
        'is_admin',
        'is_active',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function comunicados() : HasMany
    {
        return $this->hasMany(Comunicado::class);
    }

    public function eventos() : HasMany
    {
        return $this->hasMany(Evento::class);
    }

    public function confirmacoes() : HasMany
    {
        return $this->hasMany(Confirmacao::class);
    }

    public function compartilhamentos() : HasMany
    {
        return $this->hasMany(Compartilhamento::class, 'compartilhado_por');
    }

    public function aceitacoes() : HasMany
    {
        return $this->hasMany(Compartilhamento::class, 'aceito_por');
    }

    public function chamados() : HasMany
    {
        return $this->hasMany(Chamado::class);
    }

    public function mensagens() : HasMany
    {
        return $this->hasMany(Mensagem::class);
    }

    public function lojas() : BelongsToMany
    {
        return $this->belongsToMany(Loja::class, 'loja_usuario');
    }

}
