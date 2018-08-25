<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
    ];

    public function toggleStatus() {
        $this->is_active = !$this->is_active;
        return $this;
    }

    public function server()
    {
        return $this->hasOne('App\Server');
    }

    public function domains()
    {
        return $this->hasMany('App\Domain');
    }

    public function domainsSorted()
    {
        return $this->hasMany('App\Domain')->orderBy('is_active','desc')->orderBy('is_used','asc');
    }
}
