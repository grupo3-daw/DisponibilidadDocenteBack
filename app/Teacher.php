<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function availabilities()
    {
        return $this->hasMany('App\Availability');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'teacher_course');
    }
}
