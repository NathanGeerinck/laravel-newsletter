<?php

namespace App\Jobs;

use Mail;
use App\Models\User;
use App\Mail\ListImported;
use App\Models\MailingList;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ImportSubscriptions.
 * @property User user
 * @property MailingList list
 */
class ImportSubscriptions implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var MailingList
     */
    protected $user;
    protected $list;
    protected $results;

    /**
     * ImportSubscriptions constructor.
     * @param User $user
     * @param MailingList $list
     * @param $results
     */
    public function __construct(User $user, MailingList $list, $results)
    {
        $this->user = $user;
        $this->list = $list;
        $this->results = $results;
    }

    public function handle()
    {
        foreach ($this->results as $result) {
            $this->list->subscriptions()->create($result);
        }

        if (env('NOTIFICATIONS') == true) {
            Mail::to($this->user)->queue(new ListImported($this->list));
        }
    }
}
