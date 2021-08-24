<?php

namespace App\Models\Traits\Attribute;

trait InvitesAttribute
{

    /**
     * @return array
     */
    public function getRolesLabelAttribute(): array
    {
        return collect($this->inviteRoles)
            ->map(function ($role) {
                return $role->roles->display_name;
            })->all();
    }

}
