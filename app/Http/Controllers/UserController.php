<?php

namespace App\Http\Controllers;

use App\Aggregates\UserAggregate;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

readonly class UserController
{

    public function __construct(
        private UserService $userService,
    )
    {
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users)->response();
    }


    public function create(): JsonResponse {
        $userAggregate = $this
            ->userService
            ->createUser();

        return UserResource::make($userAggregate)->response();
    }

    public function show(int $id): JsonResponse {
        $userAggregate = $this
            ->userService
            ->showUser($id);

        if(! $userAggregate instanceof UserAggregate){
            abort(404);
        }

        Gate::authorize( 'view', $userAggregate);

        return UserResource::make($userAggregate)->response();
    }


    public function update(int $id): JsonResponse {
        $userAggregate = $this
            ->userService
            ->getUser($id);


        if(! $userAggregate instanceof UserAggregate){
            abort(404);
        }

        $userAggregate = $this
            ->userService
            ->updateUser($userAggregate);

        return UserResource::make($userAggregate)->response();
    }


    public function delete(int $id): JsonResponse {

        $userAggregate = $this
            ->userService
            ->getUser($id);

        if(! $userAggregate instanceof UserAggregate){
            abort(404);
        }

        $this
            ->userService
            ->deleteUser($userAggregate);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
