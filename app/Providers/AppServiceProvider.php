<?php

namespace App\Providers;

use App\Aggregates\UserAggregate;
use App\Policies\UserPolicy;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * @var string[]
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
        Gate::policy(UserAggregate::class, UserPolicy::class);
    }
}
