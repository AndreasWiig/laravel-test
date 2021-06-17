<?php

namespace App\Models;

use App\Builders\UserBuilders;
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

    // scopes Builder

    public function newEloquentBuilder($query)
    {
        return new UserBuilders($query);
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
