<?php

namespace App\Filters;


use Carbon\Carbon;

class SearchFilters extends Filters
{
    protected $filters = ['created_after', 'email'];

    public function created_after($date)
    {
        return $this->builder->createdAfter(Carbon::parse($date));
    }

    public function email($email)
    {
        return $this->builder->verifiedEmail()->signedUpYearAgo()->email($email);
    }
}
