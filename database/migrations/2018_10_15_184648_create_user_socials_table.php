<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_socials', function (Blueprint $table) {
            $table->increments('id');
               
            $table->integer('user_id')->unsigned();
            $table->string('social_network');
            $table->string('social_id');
            $table->string('social_email');
            $table->string('Social_avatar');
            
            $table->timestamps();		
       
            
            //Foreign Key
        
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('social_email')->references('email')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_socials', function (Blueprint $table) { // Deleta as foreign Key da tabela 
            $table->dropForeign('user_socials_user_id_foreign');
            $table->dropForeign('user_socials_social_email_foreign');
        });

        Schema::dropIfExists('user_socials');
    }
}
