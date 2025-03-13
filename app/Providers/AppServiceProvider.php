<?php

namespace App\Providers;

use App\Helpers\UserHelpers;

use App\Models\User;
use App\Models\Video;
use App\Policies\VideoPolicy;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
//    protected array $policies = [
//        Video::class => VideoPolicy::class,
//    ];

    protected $policies = [];
    protected function registerPolicies()
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
    public function boot(): void
    {
       $this->registerPolicies();

       UserHelpers::define_gates();

    }
}

