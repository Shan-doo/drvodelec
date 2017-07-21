<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        Storage::delete(Storage::allFiles('public/images'));

        /*Storage::delete(Storage::allFiles('public/images/thumbnails'));*/

        DB::table('category_image')->truncate();

        DB::table('images')->truncate();

        factory(App\Image::class, 15)->create()->each(function($image) {

        	$categories = range(1, 5);

        	shuffle($categories);

        	for ($i=0; $i < rand(1, 5); $i++) { 
       		
        	   	$image->categories()->attach(array_shift($categories));      	   
        	}      
                    
    	});
    }
}
