<?php

namespace App\Aggregates\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Aggregate
{
    public function getRoot(): Model;
}
