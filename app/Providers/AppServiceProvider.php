<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


/**
 * @method registerPolicies()
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-videos', function (User $user){
           return $user->hasRole('Video Manager');
        });

        Gate::define('super-admin', function (User $user){
           return $user->isSuperAdmin();
        });

    }
}

