<?php

namespace App\Models\Traits\Method;

use Illuminate\Support\Collection;

trait RoleMethod
{
    /**
     * @return Collection
     */
    public function getPermissionDisplayNames(): Collection
    {
        return $this->permissions()->pluck('display_name');
    }

    /**
     * @return Collection
     */
    public function getPermissionDescriptions(): Collection
    {
        return $this->permissions()->pluck('description');
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }
}
