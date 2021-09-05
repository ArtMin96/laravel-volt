<?php

use App\Classes\RecentSearches\RecentSearches;
use App\Classes\RecentSearches\RecentSearchesStatus;

if (! function_exists('recentSearches'))
{
    function recentSearches(): RecentSearches
    {
        $searchesStatus = app(RecentSearchesStatus::class);

        return app(RecentSearches::class)
            ->setSearchesStatus($searchesStatus);
    }
}
