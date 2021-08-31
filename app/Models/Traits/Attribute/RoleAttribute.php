<?php

namespace App\Models\Traits\Attribute;

trait RoleAttribute
{
    /**
     * @return array
     */
    public function getPermissionsLabelAttribute(): array
    {
        if (! $this->getAllPermissions()->count()) {
            return [];
        }

        return collect($this->getPermissionDisplayNames())
            ->each(function ($permission) {
                return ucwords($permission);
            })->all();
    }
}
