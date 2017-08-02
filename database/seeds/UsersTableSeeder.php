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
            'last_login' => \Carbon\Carbon::create(2017, 7, 12, 0),
            'role_id' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
      	]);

        DB::table('users')->insert([
            'username' => 'Nena',
            'email' => 'nena@example.com',
            'password' => bcrypt('password'),
            'last_login' => \Carbon\Carbon::create(2017, 7, 21, 0),
            'role_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'username' => 'Bruno    ',
            'email' => 'bruno@example.com',
            'password' => bcrypt('password'),
            'last_login' => \Carbon\Carbon::create(2017, 7, 15, 0),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        factory(App\User::class, 20)->create();

    }
}
