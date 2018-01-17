<?php

namespace App\Listeners;

use App\Models\Email;
use jdavidbakr\MailTracker\Events\ViewEmailEvent;

class EmailViewed
{
    public function __construct()
    {
        //
    }

    public function handle(ViewEmailEvent $event)
    {
        $campaign_id = $event->sent_email->getHeader('X-Campaign-ID');

        if ($campaign_id) {
            $email = Email::where('message_id', $event->sent_email->message_id)->first();
            $email->opens = $email->opens + 1;
            $email->save();
        }
    }
}
