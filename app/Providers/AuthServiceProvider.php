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

        
        Gate::define('hasToken', function($user)
        {
           
            return $user->role == "owner" || $user->role == "admin" || $user->role == "payed_user";
        });

        Gate::define('actual-user', function($user)
        {
           
            return $user->role == "user" || $user->role == "payed_user";
        });

        Gate::define('manage-user', function($user)
        {
           
            return $user->role == "owner" || $user->role == "admin";
        });

        Gate::define('owner', function($user)
        {
           
            return $user->role == "owner";
        });

  
        Gate::define('admin', function($user)
        {
            
            return $user->role == "admin";
        });

        Gate::define('user', function($user)
        {
            
            return $user->role == "user";
          
        });

  
        Gate::define('payed-user', function($user)
        {
            return $user->role == "payed_user";
        });
    
    }
}
