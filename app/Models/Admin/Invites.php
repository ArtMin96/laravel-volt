<?php

namespace App\Models\Admin;

use App\Models\Traits\Attribute\InvitesAttribute;
use App\Models\Traits\Relationship\InviteRelationship;
use Illuminate\Database\Eloquent\Model;

class Invites extends Model
{
    use InviteRelationship,
        InvitesAttribute;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
    ];

    public function roles()
    {
        return $this->hasMany(InviteRole::class);
    }

}
