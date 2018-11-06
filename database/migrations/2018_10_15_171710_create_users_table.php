<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
		//Dados Pessoais
			$table->char('cpf', 11)->unique();
			$table->string('name', 50);
			$table->char('phone', 11);
			$table->date('birth')->nullable();
			$table->char('gender', 1)->nullable();
			$table->text('notes')->nullable();
		//Dados Authenticacao
			$table->string('email',80)->unique();
			$table->string('password', 254)->nullable(); // nullable porque vai ter o recurso de cadastro usando redes sociais.

		//Permissoes

			$table->string('status')->default('active');
			$table->string('permission')->default('app.user');

			$table->rememberToken();
			$table->timestamps();
			$table->softDeletesTz(); //funcao marca como deletado no BD mas nao deleta definitavamente as informacoes
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) { // apaga o relacionamento com outras tabelas

		});

		Schema::drop('users');
	}
}
