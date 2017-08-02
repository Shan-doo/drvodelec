<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{	
	protected $fillable = ['event_id', 'feedable_id', 'feedable_type'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function feedable()
    {
    	return $this->morphTo();
    }
}
