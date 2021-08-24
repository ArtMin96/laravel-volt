<?php

namespace App\Models\Traits\Relationship;

use App\Models\Admin\Invites;
use App\Models\Admin\Role;

trait InviteRoleRelationship
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invite()
    {
        return $this->belongsTo(Invites::class);
    }

    public function roles()
    {
        return $this->hasOne(Role::class, 'name', 'role');
    }
}
