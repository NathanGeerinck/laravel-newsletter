<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'opens',
        'clicks',
        'campaign_id',
        'message_id',
    ];

    public function campiagn()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function scopeOpened($query)
    {
        return $query->where('opens', '>', 0);
    }

    public function scopeUnOpened($query)
    {
        return $query->where('opens', 0);
    }

    public function scopeClicked($query)
    {
        return $query->where('clicks', '>', 0);
    }

    public function scopeNotClicked($query)
    {
        return $query->where('clicks', 0);
    }

    public function scopeThisYear($query)
    {
        return $query->where('created_at', '>', Carbon::now()->firstOfYear());
    }
}
