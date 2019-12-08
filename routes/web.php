<?php

use App\Http\Controllers\PagesController;

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


/*

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/user/{id}', function ($id) {
    return 'This is user-id : ' . $id;
});

Route::get('/user/{id}/{name}', function ($id, $name) {
    return 'This is user-id : ' . $id ."<br>User name : " . $name;
});



Route::get('/', function () {
    return 'Hello Wolrd';
});

Route::get('/hello', function () {
    return 'Hello Wolrd';
});

*/



Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/contact_us', 'PagesController@contact');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
