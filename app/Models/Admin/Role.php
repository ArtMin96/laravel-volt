<?php

namespace App\Models\Admin;

use Spatie\Permission\Models\Role as BaseRole;
use Spatie\Translatable\HasTranslations;

class Role extends BaseRole
{
    use HasTranslations;

    public $translatable = ['display_name'];
}
