<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
        DB::table('users')->truncate();
        
	 	DB::table('users')->insert([
        	'username' => 'Nejko',
        	'email' => 'nejko@example.com',
        	'password' => bcrypt('password'),
      	]);

    }
}
