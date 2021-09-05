<?php

namespace App\Classes\RecentSearches\Exceptions;

use App\Classes\RecentSearches\Contracts\Searches;
use Exception;
use Illuminate\Database\Eloquent\Model;

class InvalidConfiguration extends Exception
{
    public static function modelIsNotValid(string $className): self
    {
        return new static("The given model class `{$className}` does not implement `".Searches::class.'` or it does not extend `'.Model::class.'`');
    }
}
