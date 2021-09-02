<?php

namespace App\Providers;

use App\Classes\SideWideSearch\SiteWideSearch;
use Illuminate\Support\ServiceProvider;

class SiteWideServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!config('site-wide-search.api.disabled')) {
            SiteWideSearch::routes();
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
