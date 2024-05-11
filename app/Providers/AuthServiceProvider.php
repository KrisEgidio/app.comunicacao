<?php

namespace App\Providers;

use App\Models\Comunicado;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('gerenciar-usuarios', function (User $user) {

            if ($user->ehAdmin()) {
                return true;
            } return false;
        });

        Gate::define('gerenciar-grupos', function (User $user) {
            if ($user->ehAdmin()) {
                return true;
            } return false;
        });


        Gate::define('gerenciar-eventos', function (User $user) {
            if ($user->ehAdmin() || $user->ehModerador()) {
                return true;
            } return false;
        });

        Gate::define('editar-evento', function (User $user, Evento $evento) {
            if ($user->ehAdmin()) {
                return true;
            } return $user->id === $evento->criado_por || $user->gruposModerador()->where('grupo_id', $evento->grupo_id)->exists();
        });

        Gate::define('deletar-evento', function (User $user, Evento $evento) {
            if ($user->ehAdmin()) {
                return true;
            } return $user->id === $evento->criado_por;
        });

        Gate::define('gerenciar-comunicados', function (User $user) {
            if ($user->ehAdmin() || $user->ehModerador()) {
                return true;
            } return false;
        });

        Gate::define('editar-comunicado', function (User $user, Comunicado $comunicado) {
            if ($user->ehAdmin()) {
                return true;
            } return $user->id === $comunicado->criado_por || $user->gruposModerador()->where('grupo_id', $comunicado->grupo_id)->exists();
        });

        Gate::define('deletar-comunicado', function (User $user, Comunicado $comunicado) {
            if ($user->ehAdmin()) {
                return true;
            } return $user->id === $comunicado->criado_por;
        });
    }
}
