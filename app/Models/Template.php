<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use Filterable;

    protected $fillable = [
        'name',
        'content'
    ];
}