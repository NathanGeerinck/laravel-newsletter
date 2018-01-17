<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

class MailingListFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relatedModel => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        return $this->where('name', 'LIKE', '%'.$name.'%');
    }
}
