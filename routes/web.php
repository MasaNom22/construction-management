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

//新規登録(管理者)
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
//ゲストログイン
// Route::get('/login/guest', 'Auth\LoginController@guestLogin')->name('login.guest');
// ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');
//ログイン状態で使用可能
Route::group(['middleware' => 'auth'], function () {
    //新規登録(ユーザー)
    Route::get('signup/users', 'Auth\RegisterUsersController@showRegistrationForm2')->name('signup.get2');
    Route::post('signup/users', 'Auth\RegisterUsersController@register2')->name('signup.post2');
    //画像投稿画面
    Route::get('/form', 'UploadImageController@show')->name("upload_form");
    //画像アップロード
    Route::post('/upload', 'UploadImageController@upload')->name("upload_image");
    
    Route::prefix('list')->group(function () {
        //画像削除
        Route::delete('{id}', 'ImageListController@destroy')->name("delete_image");
        //タスク編集
        Route::get('{id}/edit', 'UploadImageController@showEditForm')->name('image.edit');
        Route::post('{id}/edit', 'UploadImageController@edit');
        //画像表示
        Route::get('/', 'ImageListController@show')->name("image_list");
        //タスク
        Route::get('{id}/tasks', 'TasksController@index')->name('tasks.index');
        //タスク作成
        Route::get('{id}/tasks/create', 'TasksController@showCreateForm')->name('tasks.create');
        Route::post('{id}/tasks/create', 'TasksController@create');
        //タスク編集
        Route::get('{id}/tasks/{task_id}/edit', 'TasksController@showEditForm')->name('tasks.edit');
        Route::post('{id}/tasks/{task_id}/edit', 'TasksController@edit');
        //タスク一括更新
        Route::put('{id}/tasks', 'TasksController@statusedit')->name("tasks.statusedit");
        //タスク削除
        Route::delete('{id}/tasks/{task_id}', 'TasksController@destroy')->name("tasks.destroy");
    });


    //画像表示 トップページ
    Route::group(['middleware' => 'admin_auth'], function () {
        Route::get('/', 'ImageListController@show')->name("image_list");
    });
    Route::get('/home', 'HomeController@index')->name('home');
    //ユーザー一覧と検索画面
    Route::get('/users', 'UsersController@index')->name("users.index");
    //csvDownload
    Route::get('users/download_csv', 'UsersController@download_csv')->name('users.CsvDownload');
    //ユーザー編集
    Route::get('/users/{id}/edit', 'UsersController@showEditForm')->name('users.edit');
    Route::post('/users/{id}/edit', 'UsersController@edit');
    //ユーザー削除
    Route::delete('/users/{user_id}', 'UsersController@destroy')->name("users.destroy");
    //チャットコメント投稿
    Route::post('/chat/add', 'ChatsController@add')->name("chats.post");
    Route::get('/result/ajax', 'ChatsController@getData');
    //ユーザー削除
    Route::delete('/chats/delete', 'ChatsController@destroy')->name("chats.destroy");
    //チャット一覧画面
    Route::get('/chats', 'ChatsController@index')->name("chats.index");
});
