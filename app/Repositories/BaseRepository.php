<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Throwable;

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
        return $this->query()->get();
    }

    public function find(mixed $id): ?Model
    {
        return $this
            ->query()
            ->find($id)
            ?->first();
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

    public function create(Model $model, bool $refresh = false): Model
    {
        $model = $this
            ->query()
            ->create($model->getAttributes());

        return $refresh
            ? $model->refresh()
            : $model;
    }

    public function update(Model $model, bool $refresh = false): Model
    {
        $this
            ->query()
            ->where($model->getKeyName(), '=', $model->getKey())
            ->update($model->getAttributes());

        return $refresh
            ? $model->refresh()
            : $model;
    }

    public function delete(Model $model): void
    {
        $this
            ->query()
            ->where($model->getKeyName(), '=', $model->getKey())
            ->delete();
    }

    /**
     * @throws Throwable
     */
    public function deleteOrFail(Model $model): void
    {
        $this
            ->query()
            ->getConnection()
            ->transaction(fn () => $this->delete($model));
    }
}
