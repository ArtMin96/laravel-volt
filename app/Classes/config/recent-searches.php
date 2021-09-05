<?php

return [

    /*
     * If set to false, no searches will be saved to the database.
     */
    'enabled' => env('RECENT_SEARCHES_ENABLED', true),

    /*
     * When the clean-command is executed, all recording searches older than
     * the number of days specified here will be deleted.
     */
    'delete_records_older_than_days' => 365,

    /*
     * You can specify an auth driver here that gets user models.
     * If this is null we'll use the default Laravel auth driver.
     */
    'default_auth_driver' => null,

    /*
    * This model will be used to log activity.
    * It should be implements the App\Classes\RecentSearches\Contracts\Searches interface
    * and extend Illuminate\Database\Eloquent\Model.
    */
    'activity_model' => \App\Classes\RecentSearches\Models\Searches::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Searches model.
     */
    'table_name' => 'recent_searches',

    /*
     * This is the database connection that will be used by the migration and
     * the Searches model. In case it's not set Laravel database.default
     * will be used instead.
     */
    'database_connection' => env('RECENT_SEARCHES_DB_CONNECTION'),

];
