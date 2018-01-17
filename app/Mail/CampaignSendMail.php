<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @param $subscriptions
 * @property Campaign campaign
 */
class CampaignSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriptions;
    public $campaign;

    public function __construct($subscriptions, Campaign $campaign)
    {
        $this->subscriptions = $subscriptions;
        $this->campaign = $campaign;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.campaigns.send', ['campaign' => $this->campaign->name, 'subscribers' => count($this->subscriptions)])
            ->subject(trans('emails.campaigns.send.subject'));
    }
}
