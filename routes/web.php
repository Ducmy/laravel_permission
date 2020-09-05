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

Route::get('/', function () {
    return view('trang-chu');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('products', 'ProductController');
});

Route::group(['middleware' => ['role:super-admin|admin']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
});

Route::resource('/courses', 'CourseController');
Route::resource('/ddcourses', 'DDCourseController');
Route::post('/ddcourses/update-order','DDCourseController@updateOrder')->name('update-order');

Route::get('/my-account', 'MyAccountController@index')->name('my-account');
Route::post('/my-account-buy', 'MyAccountController@buy')->name('my-account-buy');
