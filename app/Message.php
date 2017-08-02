<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Conversation;

class Message extends Model
{

   /* protected $fillable = ['owner', 'body', 'conversation_id'];*/

   protected $guarded = [];

   

    public function conversation()
    {

    	return $this->belongsTo(Conversation::class);

    }

    public function feeds()
    {
    	return $this->morphMany('App\Feed', 'feedable');
    }
    
}


