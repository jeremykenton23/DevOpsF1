<?php

namespace App\Providers;

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
    public function boot():void
    {
        $this->registerPolicies();

        Gate::define('validate-lap', function ($user, $lap) {
            // Define your authorization logic here
            // For example, allowing all admins to validate:
            return $user->isAdmin();
        });
    }
}
