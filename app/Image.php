<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

class Image extends Model
{	

	protected $fillable = ['name', 'description', 'views', 'likes'];

    public function categories()
    {

    	return $this->belongsToMany(Category::class);

    }

}
