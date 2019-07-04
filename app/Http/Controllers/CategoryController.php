<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoryController extends Controller
{
    public function lista()
    {
        $categorias = Categoria::all();

        return response()->json([
            'categorias' => $categorias
             ], 201);
    }
}
