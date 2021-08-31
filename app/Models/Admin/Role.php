<?php

namespace App\Models\Admin;

use App\Models\Traits\Attribute\RoleAttribute;
use App\Models\Traits\Method\RoleMethod;
use App\Traits\Admin\HasTranslations;
use Spatie\Permission\Models\Role as BaseRole;

/**
 * @property integer $id
 * @property integer $name
 * @property string $guard_name
 * @property string $display_name
 * @property string $description
 * @property string $default
 * @property string $created_at
 * @property string $updated_at
 * @property Role $role
 */
class Role extends BaseRole
{
    use HasTranslations,
        RoleAttribute,
        RoleMethod;

    public array $translatable = [
        'display_name', 'description'
    ];
}
