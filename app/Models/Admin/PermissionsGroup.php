<?php

namespace App\Models\Admin;

use App\Traits\Admin\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class PermissionsGroup extends Model
{
    use HasTranslations;

    protected array $translatable = ['name'];

    protected $table = 'permissions_group';
}
