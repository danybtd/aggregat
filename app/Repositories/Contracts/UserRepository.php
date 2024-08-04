<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Infrastructure\Builders\UserBuilder;
use Infrastructure\Models\User;

/**
 * @extends Repository<User, UserBuilder>
 */
interface UserRepository extends Repository
{
}
