<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $builder;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;
        collect($this->getFilters())
            ->filter(fn($value, $filter) => method_exists($this, $filter))
            ->each(fn($value, $filter) => $this->$filter($value));

        return $this->builder;

    }

    private function getFilters()
    {
        return $this->request->has('filter') ? $this->request->get('filter') : [];
    }
}
