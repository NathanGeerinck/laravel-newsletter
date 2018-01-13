<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed content
 * @property mixed name
 * @property mixed user_id
 */
class Template extends Model
{
    use Filterable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'content'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}
