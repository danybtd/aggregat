<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Aggregates\Contracts\Aggregate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Throwable;

/**
 * @implements Contracts\Repository<Model, Builder, Aggregate>
 */
abstract class Repository implements Contracts\Repository
{
    /**
     * @return Collection<int, Aggregate>
     */
    public function all(): Collection
    {
        /** @var Collection<int, Aggregate> $aggregatesCollection */
        $aggregatesCollection = $this
            ->query()
            ->get()
            ->map(fn(Model $model): Aggregate => $this->aggregate($model));

        return $aggregatesCollection;
    }

    public function find(mixed $id): ?Aggregate
    {
        $model = $this
            ->query()
            ->find($id);

        return $model instanceof Model
            ? $this->aggregate($model)
            : null;
    }

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @param  array<int, string>  $columns
     */
    public function findOneBy(array $criteria, array $columns = ['*']): ?Aggregate
    {
        $model = $this
            ->query()
            ->where($criteria)
            ->select($columns)
            ->first();

        return $model instanceof Model
            ? $this->aggregate($model)
            : null;
    }

    /**
     * @param  array<int, array<int, scalar>>  $criteria
     * @return Collection<int, Aggregate>
     */
    public function findBy(
        array $criteria,
        string $sortBy,
        string $sortDirection = 'asc'
    ): Collection {

        /** @var Collection<int, Aggregate> $aggregatesCollection */
        $aggregatesCollection = $this
            ->query()
            ->where($criteria)
            ->orderBy($sortBy, $sortDirection)
            ->get()
            ->map(fn(Model $model): Aggregate => $this->aggregate($model));

        return $aggregatesCollection;
    }

    public function create(Aggregate $aggregate): Aggregate
    {
        $model = $this
            ->query()
            ->create($aggregate->getRoot()->getAttributes());

        return $this->aggregate($model);
    }

    public function update(Aggregate $aggregate): Aggregate
    {
        $this
            ->query()
            ->where($aggregate->getRoot()->getKeyName(), '=', $aggregate->getRoot()->getKey())
            ->update($aggregate->getRoot()->getAttributes());

        return $aggregate;
    }

    public function delete(Aggregate $aggregate): void
    {
        $this
            ->query()
            ->where($aggregate->getRoot()->getKeyName(), '=', $aggregate->getRoot()->getKey())
            ->delete();
    }

    /**
     * @throws Throwable
     */
    public function deleteOrFail(Aggregate $aggregate): void
    {
        $this
            ->query()
            ->getConnection()
            ->transaction(fn () => $this->delete($aggregate));
    }
}
