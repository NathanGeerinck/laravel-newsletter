<?php

namespace App\Listeners;

use App\Events\SendCampaign;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCampaign
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
     * @param  SendCampaign  $event
     * @return void
     */
    public function handle(SendCampaign $event)
    {
        //
    }
}
