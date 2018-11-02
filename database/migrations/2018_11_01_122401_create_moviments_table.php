<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMovimentsTable.
 */
class CreateMovimentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('moviments', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('product_id');
			$table->unsignedInteger('group_id');
			$table->decimal('value');
			$table->integer('type');
			
			$table->timestamps();
			$table->softDeletesTz();

			//FK's

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('product_id')->references('id')->on('products');
			$table->foreign('group_id')->references('id')->on('groups');

			           
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('moviments');
	}
}
