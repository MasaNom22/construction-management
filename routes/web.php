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
// Route::get('/', function () {
//     return view('welcome');
// });
//新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
//画像投稿
Route::get('/form', 
	[App\Http\Controllers\UploadImageController::class, "show"]
	)->name("upload_form");

Route::post('/upload', 
	[App\Http\Controllers\UploadImageController::class, "upload"]
	)->name("upload_image");
	
Route::get('/list', 
	[App\Http\Controllers\ImageListController::class, "show"]
	)->name("image_list");
Auth::routes();
//カレンダー
Route::get('/', 'CalendarController@show');

Route::get('/home', 'HomeController@index')->name('home');
