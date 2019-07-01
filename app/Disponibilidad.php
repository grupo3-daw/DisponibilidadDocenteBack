<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    protected $table = 'disponibilidades';

    public function profesor()
    {
        return $this->belongsTo('App\Profesor');
    }
}
