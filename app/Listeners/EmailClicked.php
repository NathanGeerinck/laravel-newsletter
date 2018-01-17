<?php

namespace App\Listeners;

use App\Models\Email;
use jdavidbakr\MailTracker\Events\LinkClickedEvent;

class EmailClicked
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
     * @param  LinkClickedEvent  $event
     * @return void
     */
    public function handle(LinkClickedEvent $event)
    {
        $campaign_id = $event->sent_email->getHeader('X-Campaign-ID');

        if ($campaign_id) {
            $email = Email::where('message_id', $event->sent_email->message_id)->first();
            $email->clicks = $email->clicks + 1;
            $email->save();
        }
    }
}
