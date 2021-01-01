<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

use App\UploadImage;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
         //アップロードした画像を取得
		$uploads = UploadImage::all();
        // タスク一覧ビューでそれを表示
        return view('tasks/index', [
            'images' => $uploads,
        ]);
    }
    
    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        //
    }
    
    // getでmessages/idにアクセスされた場合の「取得表示処理」
    public function show()
    {
        // 
    }
}