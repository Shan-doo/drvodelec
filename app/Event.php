<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{	
	protected $fillable = ['event_id'];

    public function feeds()
    {
    	return $this->hasMany(Event::class);
    }
}
