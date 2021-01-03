<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

use App\UploadImage;

use App\Http\Requests\CreateTasks;

use App\Http\Requests\EditTasks;

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
    public function create($id, CreateTasks $request)
{
    $current_folder = UploadImage::find($id);
    $task = new Task();
    $task->title = $request->title;
    $task->content = $request->content;
    $task->due_day = $request->due_day;

    $current_folder->tasks()->save($task);

    return redirect()->route('tasks.index', [
        'id' => $current_folder->id,
    ]);
}
    
    // getでmessages/idにアクセスされた場合の「取得表示処理」
    public function showCreateForm($id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }
    
    public function showEditForm($id, $task_id)
    {
    $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }
    
    public function edit($id,$task_id, EditTasks $request)
    {
        // 1
        $task = Task::find($task_id);
    
        // 2
        $task->title = $request->title;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->due_day = $request->due_day;
        $task->save();
    
        // 3
        return redirect()->route('tasks.index', [
            'id' => $task->upload_image_id,
        ]);
    }
    
    public function destroy($id,$task_id){
		$deletetask = Task::find($task_id);
		$redirect = Task::find($task_id);
		$deletetask->delete();
		return redirect()->route('tasks.index', [
            'id' => $redirect->upload_image_id,
        ]);
	}
}