<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    protected $fillable = [
        'email',
        'name',
        'country',
        'language',
        'mailing_list_id',
        'user_id',
    ];

    public function mailingList()
    {
        return $this->belongsTo(MailingList::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
