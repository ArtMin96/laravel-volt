<?php

namespace App\Models\Traits\Relationship;

use App\Models\Admin\Permission;

trait PermissionsGroupRelation
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_id');
    }
}
