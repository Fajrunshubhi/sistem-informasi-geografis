<?php

namespace App\Providers;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('is_superAdmin', function (User $user) {
            return Auth::user()->role == 'Super Admin';
        });
        Gate::define('is_adminDesa', function (User $user, Desa $desa) {
            return Auth::user()->desa->nama_desa == $desa->nama_desa;
        });
        Gate::define('is_self', function (User $user, User $cekUser) {
            return Auth::user()->id == $cekUser->id;
        });
        Gate::define('is_userSuperAdmin', function (User $user, User $cekUser) {
            return $cekUser->role != "Admin";
        });
    }
}
