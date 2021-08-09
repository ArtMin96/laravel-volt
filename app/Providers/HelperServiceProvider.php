<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $fileName = glob(app_path('Helpers/*.php'));

        if ($fileName !== false && is_iterable($fileName)) {
            foreach ($fileName as $file) {
                require_once $file;
            }
        }
    }
}
