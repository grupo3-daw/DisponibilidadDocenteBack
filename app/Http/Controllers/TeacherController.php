<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\User;
use App\Teacher;

class TeacherController extends Controller
{
    /** 
     * Eliminar a un profesor por id
     */
    public function delteacher(Request $request)
    {
        $deletedRows = App\Flight::where('id', request)->delete();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'category_id' => 'required',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 2,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        
        $teacher = new Teacher([
            'user_id' => $user->id,
            'category_id' => $request->category_id
        ]);
        
        $teacher->save();

        return response()->json([
            'message' => 'Successfully created teacher!'
        ], 201);
    }

    public function list()
    {
        $teachersCollection = collect([]);

        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            $t = [
                'id' => $teacher->id,
                'user_id' => $teacher->user->id,
                'user_name' => $teacher->user->name,
                'user_email' => $teacher->user->email,
                'user_role_id' => $teacher->user->role_id,
                'user_role_name' => $teacher->user->role->name,
                'category_id' => $teacher->category->id,
                'category_name' => $teacher->category->name
            ];

            $teachersCollection->push($t);
        }

        return response()->json([
            'teachers' => $teachersCollection
        ], 201);
    }

    public function get($id)
    {
        $teacher = Teacher::find($id);
        
        return response()->json([
            'id' => $teacher->id,
            'user_id' => $teacher->user->id,
            'user_name' => $teacher->user->name,
            'user_email' => $teacher->user->email,
            'user_role_id' => $teacher->user->role_id,
            'user_role_name' => $teacher->user->role->name,
            'category_id' => $teacher->category->id,
            'category_name' => $teacher->category->name
        ], 201);
    }
}