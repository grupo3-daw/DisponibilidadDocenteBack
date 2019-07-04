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
Route::post('login','SesionController@login');
Route::get('profesores','TeacherController@getTeachers');
Route::get('profesores/detalle',"TeacherController@getTeachersDetalle");
Route::get('profesores/{id}','TeacherController@getTeacherById');
Route::post('profesores/{id}/disponibilidad','AvailabilityController@postAvailability');
Route::put('profesores/{id}/disponibilidad','AvailabilityController@putAvailability');
Route::post('profesores/{id}/cursos','TeacherController@postTeacherCourses');
Route::put('profesores/{id}/cursos','TeacherController@putTeacherCourses');
Route::post('cursos','CourseController@getCourses');
Route::get('cursos/{id}','CourseController@getCourseById');
Route::post('profesores/{id}/permiso','PermissionController@requestPermission');
Route::patch('profesores/{id}/permiso/{idsolicitud}','PermissionController@approvePermission');
Route::get('profesores/{id}/categoria','TeacherController@getTeachersByCategory');
Route::get('categorias','CategoryController@lista');
