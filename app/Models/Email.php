<?php

namespace App\Models;

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
}