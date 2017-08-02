<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{	
	use Sluggable;

	protected $fillable = ['body', 'title', 'slug'];

     /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
     public function sluggable()
     {
     	return [
     		'slug' => [
     			'source' => 'title'
     		]
     	];
     }

     /**
     * Get the route key for the model.
     *
     * @return string
     */
     public function getRouteKeyName()
     {
     	return 'slug';
     }

     public function user()
     {
     	return $this->belongsTo(User::class);
     }
 }
