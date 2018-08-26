<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function server()
    {
        return $this->hasMany('App\Server');
    }

    public function campaign()
    {
        return $this->hasMany('App\Campaign');
    }

    public function setting()
    {
        return $this->hasMany('App\Setting');
    }

    public function domain()
    {
        return $this->hasMany('App\Domain');
    }
}
