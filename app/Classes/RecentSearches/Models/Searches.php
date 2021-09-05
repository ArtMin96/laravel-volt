<?php

namespace App\Classes\RecentSearches\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use App\Classes\RecentSearches\Contracts\Searches as RecentSearches;

/**
 * @property integer $id
 * @property string $description
 * @property string $user_type
 * @property integer $user_id
 * @property string $subject_type
 * @property integer $subject_id
 * @property mixed $properties
 * @property string $created_at
 * @property string $updated_at
 */
class Searches extends Model implements RecentSearches
{
    public $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'properties' => 'collection',
    ];

    public function __construct(array $attributes = [])
    {
        if (! isset($this->connection)) {
            $this->setConnection(config('recent-searches.database_connection'));
        }

        if (! isset($this->table)) {
            $this->setTable(config('recent-searches.table_name'));
        }

        parent::__construct($attributes);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): MorphTo
    {
        return $this->morphTo();
    }

    public function getExtraProperty(string $propertyName): mixed
    {
        return Arr::get($this->properties->toArray(), $propertyName);
    }

    public function scopeByUser(Builder $query, Model $user): Builder
    {
        return $query
            ->where('user_type', $user->getMorphClass())
            ->where('user_id', $user->getKey());
    }

    public function scopeForSubject(Builder $query, Model $subject): Builder
    {
        return $query
            ->where('subject_type', $subject->getMorphClass())
            ->where('subject_id', $subject->getKey());
    }

}
