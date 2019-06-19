<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class SchoolController extends Controller
{
    public function list($id)
    {
        $schools = School::where("faculty_id",$id)->get();

        return response()->json([
            'schools' => $schools
        ], 201);
    }

    public function create(Request $request)
    {
        $school = new School();

        $school->name = $request->name;
        $school->faculty_id = $request->faculty_id;

        $school->save();

        return response()->json([
            'message' => 'Successfully created school!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $school = School::find($id);

        $school->name = $request->name;
        $school->faculty_id = $request->faculty_id;

        $school->update();

        return response()->json([
            'message' => 'Successfully updated school!'
        ], 201);
    }

    public function get($id)
    {
        $school = School::find($id);

        return response()->json([
            'school' => $school
        ], 201);
    }
}
