<?php

namespace App\Aggregates;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAggregate implements Contracts\Aggregate
{

    public function __construct(private readonly User $root)
    {
    }

    public function getRoot(): User
    {
        return $this->root;
    }

    public function setEmail(string $email): self {
        $this->root->email = $email;
        return $this;
    }

    public function setName(string $name): self {
        $this->root->name = $name;
        return $this;
    }

    public function setPassword(string $password): self {
        $this->root->password = Hash::make($password);
        return $this;
    }
}
