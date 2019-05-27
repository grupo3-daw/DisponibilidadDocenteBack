<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }
}
