<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailingList extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscriptions::class, 'mailing_lists_id', 'id');
    }
}
