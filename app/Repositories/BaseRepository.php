<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Throwable;
use UnexpectedValueException;

/**
 * @implements Contracts\Repository<Model, Builder>
 */
abstract class BaseRepository implements Contracts\Repository
{
    /**
     * @return Collection<int, Model>
     */
    public function all(): Collection
    {
        return $this
            ->query()
            ->get();
    }

    public function find(string|int $id): ?Model
    {
        return $this
            ->query()
            ->find($id);
    }

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @param  array<int, string>  $columns
     */
    public function findOneBy(array $criteria, array $columns = ['*']): ?Model
    {
        return $this
            ->query()
            ->where($criteria)
            ->select($columns)
            ->first();
    }

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @return Collection<int, Model>
     */
    public function findBy(
        array $criteria,
        string $sortBy,
        string $sortDirection = 'asc'
    ): Collection {
        return $this
            ->query()
            ->where($criteria)
            ->orderBy($sortBy, $sortDirection)
            ->get();
    }

    public function create(Model $model): Model
    {
        return $this
            ->query()
            ->create($model->getAttributes());
    }

    public function createWithoutEvents(Model $model): Model
    {
        /** @var Model $model */
        $model = Model::withoutEvents(
            fn(): Model => $this->create($model)
        );

        return $model;
    }

    public function update(Model $model): bool
    {
        return $model->update($model->getAttributes());
    }

    public function updateWithoutEvents(Model $model): bool
    {
        /** @var bool $updated */
        $updated = Model::withoutEvents(
            fn(): bool => $this->update($model)
        );

        return $updated;
    }

    public function updateAndRefresh(Model $model): Model
    {
        $this->update($model);
        return $model->refresh();
    }

    public function deleteWithoutEvents(Model $model): bool
    {
        /** @var bool $deleted */
        $deleted = Model::withoutEvents(
            fn(): bool => $this->delete($model)
        );

        return $deleted;
    }

    public function delete(Model $model): bool
    {
        return (bool) $model->delete();
    }

    /**
     * @throws Throwable
     */
    public function deleteOrFail(Model $model): void
    {
        $this
            ->query()
            ->getConnection()
            ->transaction(fn (): bool => $this->delete($model));
    }
}
