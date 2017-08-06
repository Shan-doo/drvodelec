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

        'App\Events\NewsWasPublished' => [
            'App\Listeners\CreateNewsFeed',
        ],

        'App\Events\NewsWasEdited' => [
            'App\Listeners\CreateNewsEditedFeed',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogSuccessfulLogout',
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
