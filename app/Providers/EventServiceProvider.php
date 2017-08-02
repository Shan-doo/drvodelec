<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserWasRegistered' => [
            'App\Listeners\SendWelcomeEmail',
            'App\Listeners\CreateUserFeed',
        ],

        'App\Events\MessageWasReceived' => [
            'App\Listeners\CreateMessageFeed',
        ],

        'App\Events\ImageWasUploaded' => [
            'App\Listeners\CreateImageFeed',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
