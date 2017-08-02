<?php

namespace App\Listeners;

use App\Events\ImageWasUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Feed;

class CreateImageFeed
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
     * @param  ImageWasUploaded  $event
     * @return void
     */
    public function handle(ImageWasUploaded $event)
    {
        Feed::create([
            'event_id' => 3,
            'feedable_id' => $event->image->id,
            'feedable_type' => 'App\Image',
        ]);
    }
}
