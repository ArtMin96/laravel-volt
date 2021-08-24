<?php

namespace App\Models\Admin;

use App\Models\Traits\Relationship\InviteRoleRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteRole extends Model
{
    use HasFactory,
        InviteRoleRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invite_roles';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'roles',
    ];
}
