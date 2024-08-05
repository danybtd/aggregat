<?php

namespace App\Providers;

use App\Aggregates\UserAggregate;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(UserAggregate::class, UserPolicy::class);
    }
}
