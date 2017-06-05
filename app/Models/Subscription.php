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

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'country',
        'language',
        'mailing_list_id',
        'user_id',
    ];

    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeMailingList($query, $type)
    {
        return $query->where('mailing_list_id', $type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mailingList()
    {
        return $this->belongsTo(MailingList::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return mixed
     */
    public function getCampaigns()
    {
        return $this->mailingList->pluck('campaigns')->flatten();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            $subscription->unsubscribe = str_random(25);
        });
    }

}
