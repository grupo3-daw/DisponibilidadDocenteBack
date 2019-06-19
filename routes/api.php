<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Rutas a usar
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    
    // Ruta para eliminar a un profesor
    Route::delete('delteacher','TeacherController@delteacher');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        //User
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        //Category
        Route::get('categories','CategoryController@list');
        Route::get('category/get/{id}','CategoryController@get');
        Route::post('category/create','CategoryController@create');
        Route::put('category/update/{id}','CategoryController@update');
        //Teacher
        Route::get('teachers','TeacherController@list');
        Route::get('teacher/get/{id}','TeacherController@get');
        Route::post('teacher/create','TeacherController@create');
        Route::put('teacher/update/{id}','TeacherController@update'); //stand by
        //Availability
        Route::post('availability/create','AvailabilityController@create');
        Route::get('availability/teacher/get/{id}','AvailabilityController@get');
        //Faculty
        Route::get('faculties','FacultyController@list');
        Route::get('faculty/get/{id}','FacultyController@get');
        Route::post('faculty/create','FacultyController@create');
        Route::put('faculty/update/{id}','FacultyController@update');
        //School
        Route::get('schools/{id}','SchoolController@list');
        Route::get('school/get/{id}','SchoolController@get');
        Route::post('school/create','SchoolController@create');
        Route::put('school/update/{id}','SchoolController@update');
        //Course
        Route::get('courses/{id}','CourseController@list');
        Route::get('course/get/{id}','CourseController@get');
        Route::post('course/create','CourseController@create');
        Route::put('course/update/{id}','CourseController@update');
        Route::post('course/assignTeacher/{id}','CourseController@assignTeacher');
    });
});