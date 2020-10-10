<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();


// Trang chủ
Route::get('/', 'TopController@index')->name('top');

// Trang cá nhân
Route::get('/home', 'HomeController@index')->name('home');

// Quản ly học viên
Route::group(['middleware' => ['role:super-admin|admin']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('/admin/users', 'UserController');
});

// Quản lý học giáo viên
Route::group(['middleware' => ['role:super-admin|admin']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('/admin/teachers', 'TeacherController');
});


// Quản lý khóa học và các bài con
Route::group(['middleware' => ['role:super-admin|admin|teacher']], function () { 
    Route::resource('/admin/courses', 'CourseController');
    Route::resource('/admin/ddcourses', 'DDCourseController');
});


// Quản lý comment cho khóa học
Route::resource('/comments', 'CommentController');
Route::get('khoa-hoc/{course_id}', 'KhoaHocController@show')->name('khoahoc');
Route::get('khoa-hoc/{course_id}/{ddcourse_id}', 'KhoaHocController@showddcourse')->name('khdetail');
// ROute::post('/comments','CommentController@store')->name('comments');
Route::post('post-sortable','DDCourseSortingController@update');


// Quản lý thông tin cá nhân
Route::get('/thong-tin-ca-nhan.html', 'MyAccountController@index')->name('my-account');
Route::post('/my-account-buy', 'MyAccountController@buy')->name('my-account-buy');


 