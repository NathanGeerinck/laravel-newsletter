<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed content
 * @property mixed name
 */
class Template extends Model
{
    use Filterable;

    protected $fillable = [
        'name',
        'content'
    ];

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}