<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Aggregates\Contracts\Aggregate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @template TModel of Model
 * @template TBuilder of Builder
 * @template TAggregate of Aggregate
 */
interface Repository
{
    /**
     * @return TAggregate
     */
    public function aggregate(Model $model);

    /**
     * @return Collection<int, TAggregate>
     */
    public function all(): Collection;

    /**
     * @return TBuilder
     */
    public function query();

    /**
     * @return TAggregate|null
     */
    public function find(mixed $id);

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @param  array<int, string>  $columns
     * @return TAggregate|null
     */
    public function findOneBy(array $criteria, array $columns = ['*']);

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @return Collection<int, TAggregate>
     */
    public function findBy(array $criteria, string $sortBy, string $sortDirection = 'asc'): Collection;

    /**
     * @return TAggregate
     */
    public function create(Aggregate $aggregate);

    /**
     * @return TAggregate
     */
    public function update(Aggregate $aggregate);

    public function delete(Aggregate $aggregate): void;

    public function deleteOrFail(Aggregate $aggregate): void;
}
