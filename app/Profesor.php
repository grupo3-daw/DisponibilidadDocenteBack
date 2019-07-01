<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Curso');
    }

    public function disponibilidades()
    {
        return $this->hasMany('App\Disponibilidad');
    }
}
