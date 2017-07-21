<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Message;

class Conversation extends Model
{
    
	/*protected $fillable = ['client', 'email', 'subject', 'responded'];*/

	protected $guarded = [];
	

	public function messages()
	{

		return $this->hasMany(Message::class);

	}

}
