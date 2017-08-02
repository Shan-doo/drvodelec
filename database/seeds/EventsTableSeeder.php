<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $events = ['user_registered', 'message_received', 'image_uploaded'];

    public function run()
    {	
    	/*DB::table('roles')->truncate();*/

    	foreach ($this->events as $event) {
    		
    		DB::table('events')->insert([
        		'name' => $event,
        		'created_at' => \Carbon\Carbon::now(),
        		'updated_at' => \Carbon\Carbon::now(),
      		]);
    	}
    }
}
