<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @template TModel of Model
 * @template TBuilder of Builder
 */
interface Repository
{
    /**
     * @return Collection<int, TModel>
     */
    public function all(): Collection;

    /**
     * @return TBuilder
     */
    public function query();

    /**
     * @return TModel|null
     */
    public function find(string|int $id);

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @param  array<int, string>  $columns
     * @return TModel|null
     */
    public function findOneBy(array $criteria, array $columns = ['*']);

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @return Collection<int, TModel>
     */
    public function findBy(array $criteria, string $sortBy, string $sortDirection = 'asc'): Collection;

    /**
     * @return TModel
     */
    public function create(Model $model);

    /**
     * @return TModel
     */
    public function createWithoutEvents(Model $model);


    public function update(Model $model): bool;

    public function updateWithoutEvents(Model $model): bool;

    /**
     * @return TModel
     */
    public function updateAndRefresh(Model $model);

    public function delete(Model $model): bool;

    public function deleteWithoutEvents(Model $model): bool;

    public function deleteOrFail(Model $model): void;
}
