<?php

namespace App\Policies;

use App\Aggregates\UserAggregate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(?User $user, UserAggregate $userAggregate): Response
    {
        if($userAggregate->getRoot()->id === 2) {
            return $this->allow();
        }

        return $this->deny('Pas autorisé');
    }
}
