<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

class Image extends Model
{	

	protected $fillable = ['name', 'description', 'views', 'likes', 'user_id'];

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function user()
    {
     	return $this->belongsTo(User::class);
    }

    public function feeds()
    {
    	return $this->morphMany('App\Feed', 'feedable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

}
