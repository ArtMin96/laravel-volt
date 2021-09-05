<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('recent-searches.database_connection'))->create(config('recent-searches.table_name'), function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->nullableMorphs('user', 'user');
            $table->nullableMorphs('subject', 'subject');
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('recent-searches.database_connection'))->dropIfExists(config('recent-searches.table_name'));
    }
}
