<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name', 'campaign_id',
    ];

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function toggleStatus() {
        if(!$this->is_active && !$this->is_used)
            $this->is_active = true;
        else if($this->is_active && !$this->is_used)
        {
            $this->is_used = true;
            $this->is_active = false;
        }
        return $this;
    }
}