<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

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
        'uuid',
        'email',
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

    protected $uuids = ['uuid'];

    public function setUuidAttribute()
    {
        $this->attributes['uuid'] = (string) Str::uuid();
    }


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

    public function grupos() : BelongsToMany
    {
        return $this->belongsToMany(Grupo::class, 'grupo_usuario', 'usuario_id', 'grupo_id')
            ->withPivot(['usuario_id', 'grupo_id', 'moderador'])
            ->withTimestamps();
    }

}
