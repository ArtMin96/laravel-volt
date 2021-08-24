<?php

namespace App\Models\Traits\Relationship;

use App\Models\Admin\InviteRole;

trait InviteRelationship
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inviteRoles()
    {
        return $this->hasMany(InviteRole::class);
    }
}
