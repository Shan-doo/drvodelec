<?php

use Illuminate\Database\Seeder;

class SubscribersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	/*DB::table('subscribers')->truncate();*/

        factory(App\Subscriber::class, 20)->create()->each(function($subscriber) {

        	$subscriber->status = 1;

        });
    }
}
