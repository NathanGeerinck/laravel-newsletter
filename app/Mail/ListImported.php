<?php

namespace App\Mail;

use App\Models\MailingList;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @property MailingList list
 */
class ListImported extends Mailable
{
    use Queueable, SerializesModels;

    public $list;

    /**
     * ListImported constructor.
     * @param MailingList $list
     */
    public function __construct(MailingList $list)
    {
        $this->list = $list;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.lists.imported')
            ->subject(trans('emails.lists.imported.subject'))
            ->with(['list' => $this->list]);
    }
}
