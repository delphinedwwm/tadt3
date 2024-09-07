<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [  // Associe l'événement Registered à son listener CreateGameOnUserRegister
        // Place your event and listeners here, e.g.,
        // 'App\Events\SomeEvent' => [
        //     'App\Listeners\SomeEventListener',
        // ],
        \Illuminate\Auth\Events\Registered::class => [
            \App\Listeners\CreateGameOnUserRegister::class,
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

        // Register any additional events here
    }
}
