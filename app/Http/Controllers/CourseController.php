<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\School;

class CourseController extends Controller
{
    public function list($id)
    {
        $courses = Course::where("school_id",$id)->get();

        return response()->json([
            'courses' => $courses
        ], 201);
    }

    public function create(Request $request)
    {
        $course = new Course();

        $course->name = $request->name;
        $course->school_id = $request->school_id;
        $course->hours = $request->hours;

        $course->save();

        return response()->json([
            'message' => 'Successfully created course!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        $course->name = $request->name;
        $course->school_id = $request->school_id;
        $course->hours = $request->hours;

        $course->update();

        return response()->json([
            'message' => 'Successfully updated course!'
        ], 201);
    }

    public function get($id)
    {
        $course = Course::find($id);

        return response()->json([
            'course' => $course
        ], 201);
    }

    public function assignTeacher(Request $request, $id)
    {
        $course = Course::find($id);

        $course->teachers()->attach($request->teacher_id);

        return response()->json([
            'message' => 'OK'
        ], 201);
    }

    
    public function listBySchool($id)
    {
        $school = School::find($id);

        return response()->json([
            'courses' => $school->courses
        ], 201);
    }
}
