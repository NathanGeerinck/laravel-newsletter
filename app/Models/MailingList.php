<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed subscriptions
 * @property mixed campaigns
 * @property mixed public
 * @property mixed name
 */
class MailingList extends Model
{
    use Filterable;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'public'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)->withPivot('campaign_id', 'mailing_list_id');
    }
}
