<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Template;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * @property Subscription subscription
 * @property Campaign     campaign
 * @property Template     template
 */
class CampaignMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subscription, $campaign, $template;

    public function __construct(Subscription $subscription, Campaign $campaign, Template $template)
    {
        $this->subscription = $subscription;
        $this->campaign = $campaign;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->campaign->subject)
            ->view('emails.campaign')
            ->with([
                'content' => $this->str_replace_dynamic([
                    '%subject%' => $this->campaign->subject,
                    '%email%' => $this->subscription->email,
                    '%name%' => $this->subscription->name,
                    '%country%' => countries($this->subscription->country),
                    '%unsubscribe_link%' => route('subscriptions.preunsubscribe', [$this->subscription->email, $this->subscription->unsubscribe])
                ], $this->template->content)
            ])->withSwiftMessage(function ($message) {
                $headers = $message->getHeaders();
                $headers->addTextHeader('X-Campaign-ID', $this->campaign->id);
            });
    }

    public function str_replace_dynamic(array $replace, $string)
    {
        return str_replace(array_keys($replace), array_values($replace), $string);
    }
}