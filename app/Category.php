<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Image;

class Category extends Model
{	

	protected $guarded = [];
    
	public function images()
	{

		return $this->belongsToMany(Image::class);

	}

}
