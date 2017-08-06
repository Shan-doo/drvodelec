<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

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

        /*Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return bcrypt($value) == Auth::user()->password;
        });*/
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
