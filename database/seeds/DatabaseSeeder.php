<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'cpf'  => '12332112544', 
            'name' => 'jhonathan', 
            'phone' => '00000123654', 
            'birth' => '1988-02-05',
            'gender' => 'M',             
            'email' => '1@teste.com',
            'created_at' => date("Y-m-d H:i:s"),
            'password' => bcrypt('123456')
        ]);


    }
}
