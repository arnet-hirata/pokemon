<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        //
        // paid-user
        Gate::define('paid-user', function (User $user) {
            return $user->role >= 5;
        });

        // all-user
        // Gate::define('all-user', function (User $user) {
        //     return $user->role >= 0;
        // });
    }
}
