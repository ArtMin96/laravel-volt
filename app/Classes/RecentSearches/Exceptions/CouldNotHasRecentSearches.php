<?php

namespace App\Classes\RecentSearches\Exceptions;

use Exception;

class CouldNotHasRecentSearches extends Exception
{
    public static function couldNotDetermineUser($id): self
    {
        return new static("Could not determine a user with identifier `{$id}`.");
    }
}
