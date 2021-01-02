<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

use App\UploadImage;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index($id)
    {
         //アップロードした画像を取得
		$uploads = UploadImage::all();
		$uploads1 = UploadImage::find($id);
		
		    // 選ばれたフォルダを取得する
        $current_folder = UploadImage::find($id);
        
        // 選ばれたフォルダに紐づくタスクを取得する
        // $tasks = Task::where('upload_image_id', $current_folder->id)->get();
        $tasks = $current_folder->tasks()->get();
    
        // タスク一覧ビューでそれを表示
        return view('tasks/index', [
            'images' => $uploads,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
            'picture_id' => $uploads1,
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