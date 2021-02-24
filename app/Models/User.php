<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'can_get_discounts'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeCreatedAfter($query, Carbon $date)
    {
        return $query->where('created_at', $date);
    }

    // TODO
    // This should only be true for users that:
    // - Signed up at least 1 year ago on Friday the 13th for some reason ¯\_(ツ)_/¯
    // - Email must still be verified
    public function getCanGetDiscountsAttribute() : bool
    {
        return $this->email_verified_at ? true : false;
    }
}
