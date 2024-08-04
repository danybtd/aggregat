<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class UserController
{

    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function index(): JsonResponse
    {
        /** @var Collection<int, User> $users */
        $users = $this->userRepository->all();

        return UserResource::collection($users)->response();
    }

}
