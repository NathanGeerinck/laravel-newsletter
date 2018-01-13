<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed send
 * @property mixed name
 * @property mixed mailingLists
 * @property mixed subscriptions
 * @property mixed subject
 * @property mixed template
 * @property mixed id
 * @property mixed user_id
 */
class Campaign extends Model
{
    use Filterable;
    
    protected $fillable = [
        'name',
        'subject',
        'send',
        'template_id',
        'user_id'
    ];

    protected $casts = [
        'send' => 'boolean'
    ];

    public function mailingLists()
    {
        return $this->belongsToMany(MailingList::class)->withPivot('campaign_id', 'mailing_list_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function scopeNotSent($query)
    {
        return $query->whereSend(false);
    }

    public function getSubscriptions()
    {
        return $this->mailingLists->pluck('subscriptions')->flatten();
    }

    public function getRecipients()
    {
        return $this->mailingLists->pluck('subscriptions');
    }

    public function getMailingList()
    {
        return $this->mailingLists->flatten();
    }
}