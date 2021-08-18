<?php

namespace App\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Builder;

trait PermissionScope
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsMaster(Builder $query): Builder
    {
        return $query->whereDoesntHave('parent')
            ->whereHas('children');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsParent(Builder $query): Builder
    {
        return $query->whereHas('children');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsChild(Builder $query): Builder
    {
        return $query->whereHas('parent');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeSingular(Builder $query): Builder
    {
        return $query->whereNull('parent_id')
            ->whereDoesntHave('children');
    }

    /**
     * Scope a query to only include permissions with admin guard.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdminGuard(Builder $query): Builder
    {
        return $query->where('guard_name', 'admin');
    }
}
