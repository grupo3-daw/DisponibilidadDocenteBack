<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';

    public function profesor()
    {
        return $this->belongsTo('App\Profesor');
    }
}
