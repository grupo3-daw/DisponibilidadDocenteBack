<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    public function profesores()
    {
        return $this->hasMany('App\Profesor');
    }
}
