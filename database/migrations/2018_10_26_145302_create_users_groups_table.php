<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_groups', function (Blueprint $table) {
            $table->increments('id');            
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id');
            $table->string('permission')->default('default');
			$table->timestampsTz();
			$table->softDeletes();


			//Foreign keys
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //implementar methodo que remove FK junto com a tabela
    {
        Schema::dropIfExists('users_groups');
    }
}
