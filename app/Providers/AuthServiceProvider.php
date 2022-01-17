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

        Gate::before(function($user) {
            if ($user->role_id == 1)
                return true;
        });

        Gate::define('isAdmin', function($user) {
            return $user->role_id == 1;
        });

        Gate::define('update', function($user, $currentUser = null) {
            if ($user->role_id == 3 || ($currentUser && $user->id == $currentUser->id))
                return true;
            return false;
        });
    }
}
