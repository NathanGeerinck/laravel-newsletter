<?php

namespace App\Jobs;

use App\Mail\CampaignMail;
use App\Mail\CampaignSendMail;
use App\Models\Campaign;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

/**
 * @property Campaign   campaign
 * @property Template   template
 * @property Collection subscriptions
 */
class SendCampaign implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign, $subscriptions, $template;

    /**
     * SendCampaign constructor.
     *
     * @param          $subscriptions
     * @param Campaign $campaign
     * @param Template $template
     */
    public function __construct(Campaign $campaign, Template $template)
    {
        $this->campaign = $campaign;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lists = $this->campaign
            ->mailingLists()
            ->with('subscriptions')
            ->get();

        $chunk = ceil($lists->count() / 4);

        $lists->each(function ($list) use ($chunk) {
            $list->subscriptions()->chunk($chunk, function ($subscriptions) {
                $subscriptions->each(function($subscription){
                    Mail::to($subscription)->send(new CampaignMail($subscription, $this->campaign, $this->template));
                });
            });
        });

        $this->campaign->send = 1;
        $this->campaign->save();

        if (env('NOTIFICATIONS') == true) {
//            auth()->user()->notify(new CampaignSendNotification($this->subscriptions, $this->campaign));
            Mail::to(auth()->user())->queue(new CampaignSendMail($this->subscriptions, $this->campaign));
        }
    }
}
