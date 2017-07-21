<?php

use Illuminate\Database\Seeder;

use App\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	factory(App\Conversation::class, 10)->create()->each(function($c) {
 			
            for ($i=0; $i < 2; $i++) { 

               $c->messages()->save(factory(App\Message::class)->make()); 
               
            }

    	});

    }
}
