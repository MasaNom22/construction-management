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
//ゲストログイン
// Route::get('/login/guest', 'Auth\LoginController@guestLogin')->name('login.guest');

# ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

//ログイン状態で使用可能
Route::group(['middleware' => 'auth'], function() {

//画像投稿画面
Route::get('/form', 
	[App\Http\Controllers\UploadImageController::class, "show"]
	)->name("upload_form");
//画像アップロード
Route::post('/upload', 
	[App\Http\Controllers\UploadImageController::class, "upload"]
	)->name("upload_image");
//画像削除
Route::delete('/list/{id}', 'ImageListController@destroy')->name("delete_image");
//タスク編集
Route::get('/list/{id}/edit', 'UploadImageController@showEditForm')->name('image.edit');
Route::post('/list/{id}/edit', 'UploadImageController@edit');
//画像表示

Route::get('/list', 
	[App\Http\Controllers\ImageListController::class, "show"]
	)->name("image_list");

//タスク
Route::get('/list/{id}/tasks', 'TasksController@index')->name('tasks.index');
//タスク作成
Route::get('/list/{id}/tasks/create', 'TasksController@showCreateForm')->name('tasks.create');
Route::post('/list/{id}/tasks/create', 'TasksController@create');
//タスク編集
Route::get('/list/{id}/tasks/{task_id}/edit', 'TasksController@showEditForm')->name('tasks.edit');
Route::post('/list/{id}/tasks/{task_id}/edit', 'TasksController@edit');
//タスク一括更新
Route::put('/list/{id}/tasks', 'TasksController@statusedit')->name("tasks.statusedit");
//タスク削除
Route::delete('/list/{id}/tasks/{task_id}', 'TasksController@destroy')->name("tasks.destroy");
//カレンダー
//画像表示 トップページ
Route::group(['middleware' => 'admin_auth'], function () {
Route::get('/', 'ImageListController@show');
});
Route::get('/home', 'HomeController@index')->name('home');
});