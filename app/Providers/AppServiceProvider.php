<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // u/ pagination menggunakan bootstrap
        Paginator::useBootstrap();

        // u/ menggunakan authorization via gates
        Gate::define('admin', function(User $user) {
            return $user->is_admin;
        });
    }
}
