<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    public function mailingList()
    {
        return $this->hasOne(MailingList::class, 'id', 'mailing_lists_id');
    }
}
