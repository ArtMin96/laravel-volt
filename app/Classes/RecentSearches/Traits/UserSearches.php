<?php

namespace App\Classes\RecentSearches\Traits;

use App\Classes\RecentSearches\RecentSearchesServiceProvider;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait UserSearches
{
    public function actions(): MorphMany
    {
        return $this->morphMany(
            RecentSearchesServiceProvider::determineActivityModel(),
            'causer'
        );
    }
}
