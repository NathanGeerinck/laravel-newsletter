<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed campaigns
 * @property mixed email
 * @property mixed name
 * @property mixed mailingList
 * @property mixed country
 * @property mixed unsubscribe
 */
class Subscription extends Model
{
    use Filterable;

    protected $fillable = [
        'email',
        'name',
        'country',
        'language',
        'mailing_list_id',
        'user_id',
    ];

    public function scopeMailingList($query, $type)
    {
        return $query->where('mailing_list_id', $type);
    }

    public function mailingList()
    {
        return $this->belongsTo(MailingList::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getCampaigns()
    {
        return $this->mailingList->pluck('campaigns')->flatten();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            $subscription->unsubscribe = str_random(10);
        });
    }

}
