<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;

class FacultyController extends Controller
{
    public function list()
    {
        $faculties = Faculty::all();

        return response()->json([
            'faculties' => $faculties
        ], 201);
    }

    public function create(Request $request)
    {
        $faculty = new Faculty();

        $faculty->name = $request->name;

        $faculty->save();

        return response()->json([
            'message' => 'Successfully created faculty!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $faculty = Faculty::find($id);

        $faculty->name = $request->name;

        $faculty->update();

        return response()->json([
            'message' => 'Successfully updated faculty!'
        ], 201);
    }

    public function get($id)
    {
        $faculty = Faculty::find($id);

        return response()->json([
            'faculty' => $faculty
        ], 201);
    }
}
