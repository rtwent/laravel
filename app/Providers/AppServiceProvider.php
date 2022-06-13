<?php

namespace App\Providers;

use App\Repositories\PgSql\UserRepository;
use App\Repositories\Specification\IUserRepository;
use App\Services\Auth\Login;
use App\Services\Auth\Register;
use App\Services\Sender\GuzzleSender;
use App\Services\Specification\Auth\ILogin;
use App\Services\Specification\Auth\IRegister;
use App\Services\Specification\Sender\ISender;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IRegister::class, Register::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ILogin::class, Login::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
