<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'name', 'campaign_id', 'server_type', 'server_ip', 'server_username', 'server_password'
    ];

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}
