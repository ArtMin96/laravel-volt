<?php

namespace App\Models\Admin;

use App\Traits\Admin\HasTranslations;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasTranslations;

    public array $translatable = [
        'display_name', 'description'
    ];
}
