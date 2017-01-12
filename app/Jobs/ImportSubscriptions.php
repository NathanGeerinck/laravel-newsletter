<?php

namespace App\Jobs;

use App\Models\MailingList;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImportSubscriptions implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $list, $results;

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
