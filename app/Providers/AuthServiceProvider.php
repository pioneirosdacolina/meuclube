<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isVisitante', function ( $user ){
            return $user->role === 'visitante';
        });

        Gate::define('isDesbravador', function ( $user ){
            return $user->role === 'desbravador';
        });

        Gate::define('isResponsavel', function ( $user ){
            return $user->role === 'responsavel';
        });

        Gate::define('isConselheiro', function ( $user ){
            return $user->role === 'conselheiro';
        });

        Gate::define('isInstrutor', function ( $user ){
            return $user->role === 'instrutor';
        });

        Gate::define('isAnciao', function ( $user ){
            return $user->role === 'anciao';
        });

        Gate::define('isTesoureiro', function ( $user ){
            return $user->role === 'tesoureiro';
        });

        Gate::define('isSecretaria', function ( $user ){
            return $user->role === 'secretaria';
        });

        Gate::define('isDiretorAssociado', function ( $user ){
            return $user->role === 'diretor_assoc';
        });

        Gate::define('isDiretor', function ( $user ){
            return $user->role === 'diretor';
        });

        Gate::define('isAdministrador', function ( $user ){
            return $user->role === 'administrador';
        });

        Passport::routes();
        //
    }
}
