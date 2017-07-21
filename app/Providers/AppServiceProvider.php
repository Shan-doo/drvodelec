<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Mail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repos\ImageRepositoryInterface', 'App\Repos\ImageRepository');

        $this->app->bind('App\Repos\MessageRepositoryInterface', 'App\Repos\MessageRepository');

        $this->app->bind('App\Repos\SubscriberRepositoryInterface', 'App\Repos\SubscriberRepository'); 
    }
}
