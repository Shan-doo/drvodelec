<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Feed;

class CreateUserFeed
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {   
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered  $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        Feed::create([
            'event_id' => 1,
            'feedable_id' => $event->user->id,
            'feedable_type' => 'App\User',
            'user_id' => $event->user->id,
        ]);
    }
}
