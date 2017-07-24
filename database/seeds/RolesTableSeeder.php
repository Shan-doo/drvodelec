<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $categories = ['user', 'admin', 'superadmin'];

    public function run()
    {	
    	/*DB::table('roles')->truncate();*/

    	foreach ($this->categories as $category) {
    		
    		DB::table('roles')->insert([
        		'name' => $category,
        		'created_at' => \Carbon\Carbon::now(),
        		'updated_at' => \Carbon\Carbon::now(),
      		]);
    	}

        
    }
}
