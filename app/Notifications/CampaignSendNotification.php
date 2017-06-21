<?php

namespace App\Notifications;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CampaignSendNotification extends Notification
{
    use Queueable;

    public $subscriptions, $campaign;

    /**
     * CampaignSendNotification constructor.
     * @param $subscriptions
     * @param Campaign $campaign
     */
    public function __construct($subscriptions, Campaign $campaign)
    {
        $this->subscriptions = $subscriptions;
        $this->campaign = $campaign;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('emails.campaigns.send.subject'))
            ->markdown('emails.campaigns.send');
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from(env('APP_FROM'))
            ->content(trans('emails.campaigns.send.text', ['campaign' => $this->campaign, 'subscribers' => $this->subscriptions]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}