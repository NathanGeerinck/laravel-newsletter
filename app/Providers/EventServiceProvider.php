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
        'jdavidbakr\MailTracker\Events\EmailSentEvent' => [
            \App\Listeners\EmailSent::class,
        ],
        'jdavidbakr\MailTracker\Events\ViewEmailEvent' => [
            \App\Listeners\EmailViewed::class,
        ],
        'jdavidbakr\MailTracker\Events\LinkClickedEvent' => [
          \App\Listeners\EmailClicked::class,
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
