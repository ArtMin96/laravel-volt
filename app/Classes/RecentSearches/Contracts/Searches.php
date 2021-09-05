<?php

namespace App\Classes\RecentSearches\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

interface Searches
{
    public function subject(): MorphTo;

    public function user(): MorphTo;

    public function getExtraProperty(string $propertyName): mixed;

    public function scopeByUser(Builder $query, Model $causer): Builder;

    public function scopeForSubject(Builder $query, Model $subject): Builder;
}
