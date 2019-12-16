<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    

 
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});



    Route::get('/admin', function(){
        return view('admin');
    })->middleware('admin');
     
    Route::get('/dean', function(){
      return view('dean');
    })->middleware('dean');
     
    Route::get('/instructor', function(){
        return view('instructor');
    })->middleware('instructor');
    // any route here will only be accessible for logged in users


Route::get('/home', 'HomeController@index')->name('home');
Route::resource('courses', 'CourseController')->middleware('dean');
Route::resource('coursesmarks', 'CourseMarksController')->middleware('instructor');
Route::resource('clomarks', 'CourseCloController')->middleware('instructor');
Route::get('/offeredcourses/{id}/destroy', ['uses' => 'OfferedController@destroy'])->middleware('admin');
// Route::get('/plo', 'PloController@index')->middleware('admin');
// Route::post('/submit', 'PloController@find')->middleware('admin');
Route::resource('plotranscript', 'PloController')->middleware('admin');
Route::resource('semesters', 'SemesterController')->middleware('admin');
Route::resource('degreeplans', 'DegreePlanController')->middleware('dean');
Route::resource('cloplos', 'CloPloController')->middleware('dean');

Route::post('/submit','PloController@fun');


Route::resource('semestercourses', 'SemesterCourseController')->middleware('admin');



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
