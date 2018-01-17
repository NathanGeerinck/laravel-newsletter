<?php

namespace App\Listeners;

use App\Models\Email;
use jdavidbakr\MailTracker\Events\EmailSentEvent;

class EmailSent
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmailSentEvent  $event
     * @return void
     */
    public function handle(EmailSentEvent $event)
    {
        $campaign_id = $event->sent_email->getHeader('X-Campaign-ID');

        if ($campaign_id) {
            Email::create([
                'campaign_id' => $campaign_id,
                'message_id' => $event->sent_email->message_id
            ]);
        }
    }
}
