<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
