<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

/**
 * @property integer $id
 * @property integer $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $email_verified_at
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class User extends Authenticatable
{
    use HasFactory,
        Notifiable,
        Searchable;

    /**
     * Declare the searchable fields.
     */
    const SEARCHABLE_FIELDS = [
        'id',
        'first_name',
        'last_name',
        'email',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return $this->only(self::SEARCHABLE_FIELDS);
    }
}
