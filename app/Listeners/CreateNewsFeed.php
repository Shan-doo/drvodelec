<?php

namespace App\Listeners;

use App\Events\NewsWasPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\Feed;

class CreateNewsFeed
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
     * @param  NewsWasPublished  $event
     * @return void
     */
    public function handle(NewsWasPublished $event)
    {
        Feed::create([
            'event_id' => 4,
            'feedable_id' => $event->news->id,
            'feedable_type' => 'App\News',
            'user_id' => Auth::user()->id,
        ]);
    }
}
