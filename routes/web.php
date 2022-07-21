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
    return redirect(route('home'));
});

Auth::routes();
/* ================================
                HOME
=================================*/
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/search', 'HomeController@search')->name('home.search');
/* ================================
                COURSE
=================================*/
Route::get('/course', 'CourseController@index')->name('course');

Route::resource('/course', 'CourseController')->except('index', 'show')->middleware('auth');

Route::get('/course/filter/{category}','CourseController@filter')->name('home.filter');

Route::get('/course/{course}/enroll', 'CourseController@enroll')->name('course.enroll');

Route::get('/course/{course}/unenroll', 'CourseController@unenroll')->name('course.unenroll');

Route::get('/course/{course}/complete', 'CourseController@complete')->name('course.complete');

Route::get('/course/test/{id}', function ($id) {
    return view('courses.test',compact('id'));
})->name('course.test');

Route::get('/course/{course}', 'CourseController@show')->name('course.show');

Route::post('/course/search', 'CourseController@search')->name('course.search');
/* ================================
                ACCOUNT
=================================*/
Route::resource('/user', 'UserController')->except('show')->middleware('auth');

Route::get('/user/{user}/account', 'UserController@account')->name('user.account');
/* ================================
                DASHBOARD
=================================*/
Route::get('/dashboard', 'EnrollmentController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/dashboard/{user}/{course}/approve', 'EnrollmentController@approve')->name('enrollment.approve');

Route::get('/dashboard/{user}/{course}/disapprove', 'EnrollmentController@disapprove')->name('enrollment.disapprove');
/* ================================
                CATEGORY
=================================*/
Route::get('/categories', 'CategoryController@index')->name('category.index');
/* ================================
                ENROLLMENT
=================================*/
Route::get('enrollment/my_courses', 'EnrollmentController@getMyCourse')->name('enrollments.mycourse');