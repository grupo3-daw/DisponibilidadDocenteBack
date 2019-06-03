<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Availability;

class AvailabilityController extends Controller
{
    public function create(Request $request)
    {
        $availability = new Availability();
        
        $availability->day = $request->day;
        $availability->end_time = $request->end_time;
        $availability->start_time = $request->start_time;
        $availability->status = $request->status;
        $availability->teacher_id = $request->teacher_id;

        $availability->save();

        return response()->json([
            'message' => 'Successfully created availability!'
        ], 201);
    }

    public function get($id)
    {
        $availabilities = Availability::where('teacher_id',$id)->get();

        return response()->json([
            'availabilities' => $availabilities
        ], 201);
    }
}
