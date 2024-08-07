<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController
{

    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function index(): JsonResponse
    {
        $users = $this->userRepository->all();

        return UserResource::collection($users)->response();
    }

}
