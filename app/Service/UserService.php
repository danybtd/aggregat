<?php

namespace App\Service;

use App\Aggregates\UserAggregate;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

readonly class UserService
{

    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    /**
     * @return Collection<int, UserAggregate>
     */
    public function getAllUsers(): Collection {
        return $this
            ->userRepository
            ->all();
    }


    public function createUser(): UserAggregate {
        return $this
            ->userRepository
            ->create(
                $this
                    ->userRepository
                    ->aggregate(new User())
                    ->setEmail(Str::random(48))
                    ->setName("Dany Bitard")
                    ->setPassword("test")
            );
    }

    public function showUser(int $id): ?UserAggregate {
        return $this
            ->userRepository
            ->find($id);
    }

    public function getUser(int $id): ?UserAggregate {
        return $this
            ->userRepository
            ->findOneBy([
                ['id', '=', $id]
            ]);
    }

    public function updateUser(UserAggregate $userAggregate): ?UserAggregate {
        $userAggregate->setName(Str::random());
        $userAggregate->setEmail("EMAIL MIS A JOUR");

        $this
            ->userRepository
            ->update($userAggregate);

        return $userAggregate;
    }

    public function deleteUser(UserAggregate $userAggregate): void {
        $this
            ->userRepository
            ->delete($userAggregate);
    }
}
