<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    
    public function schools()
    {
        return $this->hasMany('App\School');
    }
}
