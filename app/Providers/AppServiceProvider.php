<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFour();

        // role utama
        Gate::define('mahasiswa', function (User $user) {
            return  $user->level_id === 1;
        });
        Gate::define('pembimbing', function (User $user) {
            return  $user->level_id === 2;
        });
        Gate::define('koordinator', function (User $user) {
            return  $user->level_id === 3;
        });
        Gate::define('admin', function (User $user) {
            return  $user->level_id === 4;
        });

        // role campuran
        Gate::define('adXkoor', function (User $user) {
            return  $user->level_id === 4 || $user->level_id === 3;
        });
        Gate::define('pemXkoor', function (User $user) {
            return  $user->level_id === 3 || $user->level_id === 2;
        });
        Gate::define('adXmah', function (User $user) {
            return  $user->level_id === 4 || $user->level_id === 1;
        });
        Gate::define('!mahasiswa', function (User $user) {
            return  $user->level_id !== 1;
        });
        Gate::define('!pembimbing', function (User $user) {
            return  $user->level_id !== 2;
        });
        Gate::define('!koordinator', function (User $user) {
            return  $user->level_id !== 3;
        });
    }
}
