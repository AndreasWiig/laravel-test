<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function IpLogs()
    {
        return $this->hasMany(Log::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function scopeCreatedAfter($query, Carbon $date)
    {
        return $query->where('created_at', '>', $date);
    }

    public function scopeUserByEmail($query, $email)
    {
        $query->where('email', $email);
    }

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeVerifiedEmail($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    public function scopeSignedUpYearAgo($query)
    {
        return $query->where('email_verified_at', '<', Carbon::now()->subYear());
    }

    public function getCanGetDiscountsAttribute() : bool
    {
        return $this->email_verified_at ? true : false;
    }

    public function logIpEntry()
    {
        return $this->IpLogs()->create();
    }
}
