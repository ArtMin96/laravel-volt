<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInviteRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invites_id');
            $table->string('role');

            $table->foreign('invites_id')
                ->references('id')
                ->on('invites')
                ->onDelete('cascade');

            $table->foreign('role')
                ->references('name')
                ->on('roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invite_roles');
    }
}
