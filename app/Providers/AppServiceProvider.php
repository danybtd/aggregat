<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepository as UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * @var array<class-string, class-string>
     */
    public $bindings = [
        UserRepositoryContract::class => UserRepository::class,
    ];

    public function register(): void
    {
        //
    }


    public function boot(): void
    {

    }
}
