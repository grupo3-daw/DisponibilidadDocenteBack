<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'teacher_course');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
