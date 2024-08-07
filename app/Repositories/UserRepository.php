<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builders\UserBuilder;
use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function query(): UserBuilder
    {
        return User::query();
    }
}
