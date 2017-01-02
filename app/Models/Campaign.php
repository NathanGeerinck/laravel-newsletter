<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed send
 * @property mixed name
 * @property mixed mailingLists
 */
class Campaign extends Model
{
    use Filterable;
    
    protected $fillable = [
        'name',
        'subject',
        'send',
        'template_id'
    ];

    public function mailingLists()
    {
        return $this->belongsToMany(MailingList::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class)->withPivot('campaign_mailing_list');
    }

    public function scopeNotSent($query)
    {
        return $query->where('send', 0);
    }
}