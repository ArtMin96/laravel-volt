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
     * @return string
     */
    public function getRolesLabelAttribute(): string
    {
        if ($this->hasAllRoles(Role::all())) {
            return 'All';
        }

        if (! $this->roles()->count()) {
            return 'None';
        }

        return collect($this->getRoleNames())
            ->each(function ($role) {
                return ucwords($role);
            })
            ->implode('<br/>');
    }

    /**
     * @return string
     */
    public function getPermissionsLabelAttribute(): string
    {
        if (! $this->getAllPermissions()->count()) {
            return 'None';
        }

        return collect($this->getAllPermissions()->pluck('display_name'))
            ->each(function ($permission) {
                return ucwords($permission);
            })->implode('<br/>');
    }
}
