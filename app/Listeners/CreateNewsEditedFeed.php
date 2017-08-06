<?php

namespace App\Listeners;

use App\Events\NewsWasEdited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\Feed;

class CreateNewsEditedFeed
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
     * @param  NewsWasEdited  $event
     * @return void
     */
    public function handle(NewsWasEdited $event)
    {
        Feed::create([
            'event_id' => 5,
            'feedable_id' => $event->news->id,
            'feedable_type' => 'App\News',
            'user_id' => Auth::user()->id,
        ]);
    }
}
