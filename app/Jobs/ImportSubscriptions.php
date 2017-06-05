<?php

namespace App\Jobs;

use App\Models\MailingList;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class ImportSubscriptions
 * @package App\Jobs
 */
class ImportSubscriptions implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var MailingList
     */
    protected $list, $results;

    /**
     * ImportSubscriptions constructor.
     * @param MailingList $list
     * @param $results
     */
    public function __construct(MailingList $list, $results)
    {
        $this->list = $list;
        $this->results = $results;
    }

    public function handle()
    {
        foreach ($this->results as $result) {
            $this->list->subscriptions()->create($result);
        }
    }
}
