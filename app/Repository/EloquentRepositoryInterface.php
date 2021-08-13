<?php

namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * Get all models.
     *
     * @param array|string[] $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Paginate the given model into a simple paginator.
     *
     * @param null $perPage
     * @param array|string[] $columns
     * @param string $pageName
     * @param null $page
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = null, array $columns = ['*'], string $pageName = 'page', $page = null, array $relations = []): LengthAwarePaginator;

    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection;

    /**
     * Find model by id.
     *
     * @param int $modelId
     * @param array|string[] $columns
     * @param array $relations
     * @param array $appends
     * @return Model|null
     */
    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    /**
     * Find trashed model by id.
     *
     * @param int $modelId
     * @return Model|null
     */
    public function findTrashedById(int $modelId): ?Model;

    /**
     * Find only trashed model by id.
     *
     * @param int $modelId
     * @return Model|null
     */
    public function findOnlyTrashedById(int $modelId): ?Model;

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model;

    /**
     * Update existing model.
     *
     * @param int $modelId
     * @param array $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool;

    /**
     * Delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * Restore model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool;

    /**
     * Permanently delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool;
}
