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

    public function domains()
    {
        return $this->hasMany('App\Domain');
    }
}
