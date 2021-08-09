<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionColumnToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->json('display_name')->after('name');
        });

        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->json('display_name')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (Schema::hasColumn($tableNames['permissions'], 'display_name')) {
            Schema::table($tableNames['permissions'], function (Blueprint $table) {
                $table->dropColumn('display_name');
            });
        }

        if (Schema::hasColumn($tableNames['roles'], 'display_name')) {
            Schema::table($tableNames['roles'], function (Blueprint $table) {
                $table->dropColumn('display_name');
            });
        }
    }
}
