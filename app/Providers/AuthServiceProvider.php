<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();



        Gate::define('manage-users', function($user)
        {
            return $user->hasAnyRoles(['admin', 'owner']);
        });

        Gate::define('edit-users', function($user)
        {
            return $user->hasAnyRoles(['admin', 'owner']);
        });

        Gate::define('delete-users', function($user)
        {
            return $user->hasRole('owner');
        });

        Gate::define('is-user', function($user)
        {
            return $user->hasRole('user');
        });

        Gate::define('is-admin', function($user)
        {
            return $user->hasRole('admin');
        });
        
        Gate::define('is-payed', function($user)
        {
            return $user->hasRole('payed_user');
        });
        Gate::define('any-user', function($user)
        {
            return $user->hasAnyRoles(['user', 'payed_user']);
        });
    }
}
