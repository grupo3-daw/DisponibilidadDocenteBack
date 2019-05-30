<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
class TeacherController extends Controller
{
    /** 
     * Eliminar a un profesor por id
     */
    public function delteacher(Request $request)
    {
        $deletedRows = App\Flight::where('id', request)->delete();
    }
}