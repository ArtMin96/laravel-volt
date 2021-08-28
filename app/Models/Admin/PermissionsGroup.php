<?php

namespace App\Models\Admin;

use App\Models\Traits\Relationship\PermissionsGroupRelation;
use App\Traits\Admin\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class PermissionsGroup extends Model
{
    use HasTranslations,
        PermissionsGroupRelation;

    protected array $translatable = ['name'];

    protected $table = 'permissions_group';
}
