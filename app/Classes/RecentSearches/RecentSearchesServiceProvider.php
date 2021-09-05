<?php

namespace App\Classes\RecentSearches;

use App\Classes\RecentSearches\Exceptions\InvalidConfiguration;
use Illuminate\Database\Eloquent\Model;
use App\Classes\RecentSearches\Contracts\Searches;
use App\Classes\RecentSearches\Contracts\Searches as SearchesContract;
use App\Classes\RecentSearches\Models\Searches as SearchesModel;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RecentSearchesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-recent-searches')
            ->hasConfigFile('recent-searches')
            ->hasMigrations([
                'create_recent_searches_table',
            ]);
    }

    public static function determineActivityModel(): string
    {
        $activityModel = config('recent-searches.activity_model') ?? SearchesModel::class;

        if (! is_a($activityModel, Searches::class, true)
            || ! is_a($activityModel, Model::class, true)) {
            throw InvalidConfiguration::modelIsNotValid($activityModel);
        }

        return $activityModel;
    }

    public static function getActivityModelInstance(): SearchesContract
    {
        $activityModelClassName = self::determineActivityModel();

        return new $activityModelClassName();
    }
}
