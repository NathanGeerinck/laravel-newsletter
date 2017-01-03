<?php

namespace App\Jobs;

use App\Mail\CampaignMail;
use App\Models\Campaign;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

/**
 * @property Campaign campaign
 * @property Template template
 * @property Collection subscriptions
 */
class SendCampaign implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;
    protected $subscriptions;
    protected $template;

    public function __construct($subscriptions, Campaign $campaign, Template $template)
    {
        $this->campaign = $campaign;
        $this->subscriptions = $subscriptions;
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->subscriptions as $subscription){
            Mail::to($subscription)->send(new CampaignMail($subscription, $this->campaign, $this->template));
        }
    }
}
