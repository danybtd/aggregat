<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Aggregates\UserAggregate;
use App\Builders\UserBuilder;
use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;

class UserRepository extends Repository implements UserRepositoryContract
{
    /**
     * @param User $model
     */
    public function aggregate($model): UserAggregate
    {
        return new UserAggregate($model);
    }

    public function query(): UserBuilder
    {
        return User::query();
    }
}
