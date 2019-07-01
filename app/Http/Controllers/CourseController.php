<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\School;
use App\Curso;

class CourseController extends Controller
{
    public function getCourses(Request $request)
    {
        if($request->nombre && $request->nombre != '')
        {
            $cursos = Curso::where('nombrecurso','LIKE','%'. $request->nombre .'%')->get();
        }
        else
        {
            $cursos = Curso::all();
        }

        return response()->json([
            'cursos' => $cursos
        ], 201);
    }

    //NO USAR
    public function getCourseById($id)
    {
        $curso = Curso::where('id',$id)->with('profesores')->first();
        //Incluir profesores que escogieron ese curso
        return response()->json([
            'curso' => $curso
        ], 201);
    }
}
