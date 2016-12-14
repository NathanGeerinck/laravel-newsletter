<?php namespace App\Filters;

use EloquentFilter\ModelFilter;

class SubscriptionsFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relatedModel => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function filter($filter)
    {
        return $this->where(function($q) use ($filter)
        {
            return $q->where('email', 'LIKE', '%'. $filter . '%')
                ->orWhere('name', 'LIKE', '%' . $filter . '%');
        });
    }

    public function mailing_list($id)
    {
        return $this->where('mailing_list_id', $id);

    }

}