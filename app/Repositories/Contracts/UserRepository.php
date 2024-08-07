<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Builders\UserBuilder;
use App\Models\User;

/**
 * @extends Repository<User, UserBuilder>
 */
interface UserRepository extends Repository
{
}
