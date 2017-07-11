<?php

namespace App\Jobs;

use App\Mail\ListImported;
use App\Models\MailingList;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

/**
 * Class ImportSubscriptions
 * @property User user
 * @property MailingList list
 * @package App\Jobs
 */
class ImportSubscriptions implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var MailingList
     */
    protected $user, $list, $results;

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

        if($this->user->notifications == true) {
            Mail::to($this->user)->queue(new ListImported($this->list));
        }
    }
}
