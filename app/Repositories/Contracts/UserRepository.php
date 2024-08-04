<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Aggregates\UserAggregate;
use App\Builders\UserBuilder;
use App\Models\User;

/**
 * @extends Repository<User, UserBuilder, UserAggregate>
 */
interface UserRepository extends Repository
{
}
