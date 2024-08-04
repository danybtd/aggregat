<?php

namespace App\Policies;

use App\Aggregates\UserAggregate;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function canUpdate(UserAggregate $userAggregate): Response
    {
        if($userAggregate->getRoot()->id === 2){
            Response::allow();
        }

        return Response::deny('Pas autorisé');
    }
}
