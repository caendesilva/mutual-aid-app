<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('isStaff', function (\App\Models\User $user) {
            return $user->isStaff();
        });

        Gate::define('isMod', function (\App\Models\User $user) {
            return $user->hasRole('mod');
        });

        Gate::define('isAdmin', function (\App\Models\User $user) {
            return $user->hasRole('admin');
        });

        // Define the dashboard gate
        Gate::define('accessDashboard', function (\App\Models\User $user) {
            return $user->isStaff();
        });

        // Define the gate to manage users
        Gate::define('manageUsers', function (\App\Models\User $user) {
            return $user->hasRole('admin');
        });
    }
}
