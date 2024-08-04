<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builders\UserBuilder;
use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * @return UserBuilder<User>
     */
    public function query(): UserBuilder
    {
        return User::query();
    }
}
