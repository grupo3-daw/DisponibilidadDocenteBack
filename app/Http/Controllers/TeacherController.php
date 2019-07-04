<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Profesor;
use App\Curso;

class TeacherController extends Controller
{
    public function getTeachers(Request $request)
    {
        if($request->nombre && $request->nombre != '')
        {
            $profesores = Profesor::where('nombre','LIKE','%'+ $request->nombre +'%')->orWhere('appaterno','LIKE','%'+ $request->nombre +'%')->orWhere('appmaterno','LIKE','%'+ $request->nombre +'%')->get();
        }
        else
        {
            $profesores = Profesor::all();
        }

        return response()->json([
            'profesores' => $profesores
        ], 201);
    }

    public function getTeachersDetalle() {
        $profesores = Profesor::with('categoria','cursos','disponibilidades','permisoObject')->get();
        return response()->json([
            'profesores' => $profesores
        ], 201);
    }

    public function getTeacherById($id)
    {
        $profesor = Profesor::where('id',$id)->with('categoria','cursos','disponibilidades','permisoObject')->first();
        //Incluir categoria, cursos y disponibilidad
        return response()->json([
            'profesor' => $profesor
        ], 201);
    }

    public function postTeacherCourses(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        if(count($request->cursos) != 4 )
        {
            return response()->json([
                'WrongNumberCourses' => 'Debe seleccionar 4 cursos.'
            ], 404);
        }

        foreach ($request->cursos as $curso_id) {
            $profesor->cursos()->attach($curso_id);
        }

        $profesor->permiso = 1;

        $profesor->update();

        return response()->json([
              'mensaje' => 'Cursos registrados'
               ], 201);
    }


    public function putTeacherCourses(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        if(count($request->cursos) != 4 )
        {
            return response()->json([
                'WrongNumberCourses' => 'Debe seleccionar 4 cursos.'
            ], 404);
        }

        DB::table('curso_profesor')->where('profesor_id', $id)->delete();

        foreach ($request->cursos as $curso_id) {
            $profesor->cursos()->attach($curso_id);
        }

        $profesor->permiso = 1;

        $profesor->update();

        return response()->json([
              'mensaje' => 'Cursos actualizados'
               ], 201);
    }

    public function getTeachersByCategory($id)
    {
        $profesores = Profesor::where('categoria_id',$id)->get();

        return response()->json([
            'profesores' => $profesores
             ], 201);
    }

}
