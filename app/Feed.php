<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{	
	protected $fillable = ['event_id', 'feedable_id', 'feedable_type', 'user_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function feedable()
    {
    	return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
