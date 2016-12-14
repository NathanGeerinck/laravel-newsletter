<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class MailingList extends Model
{
    use Filterable;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscriptions::class);
    }
}
