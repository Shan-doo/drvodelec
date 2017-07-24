<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(SubscribersTableSeeder::class);
        
    }
}
