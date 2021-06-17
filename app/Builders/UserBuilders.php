<?php

namespace App\Builders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UserBuilders extends Builder
{
    public function filter($filters)
    {
        $filters->apply($this);

        return $this;
    }

    public function createdAfter(Carbon $date)
    {
        $this->where('created_at', '>', $date);

        return $this;

    }

    public function userByEmail($email)
    {
        $this->where('email', $email);

        return $this;

    }

    public function verifiedEmail()
    {
        $this->whereNotNull('email_verified_at');

        return $this;

    }

    public function signedUpYearAgo()
    {
        $this->where('email_verified_at', '<', Carbon::now()->subYear());

        return $this;
    }
}
