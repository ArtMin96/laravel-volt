<?php

namespace App\Models\Traits\Attribute;

use App\Models\Admin\Role;

trait AdminAttribute
{
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @return array
     */
    public function getRolesLabelAttribute(): array
    {
        if (! $this->roles()->count()) {
            return [];
        }

        return collect($this->getRoleNames())
            ->each(function ($role) {
                return ucwords($role);
            })->all();
    }

    /**
     * @return array
     */
    public function getPermissionsLabelAttribute(): array
    {
        if (! $this->getAllPermissions()->count()) {
            return [];
        }

        return collect($this->getAllPermissions()->pluck('display_name'))
            ->each(function ($permission) {
                return ucwords($permission);
            })->all();
    }
}
