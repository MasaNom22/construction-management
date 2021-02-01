<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; 

use App\Tag;

use App\UploadImage;

use App\Http\Requests\CreateTasks;

use App\Http\Requests\EditTasks;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index($id)
    {
         //アップロードした画像を取得
		$image = UploadImage::all();
		
		// 選ばれた画像のを取得する
        $current_image = UploadImage::find($id);
        
        // 関係するモデルの件数をロード
        $current_image->loadRelationshipCounts();
        
        // 選ばれた画像に紐づくタスクを取得する
        // $tasks = Task::where('upload_image_id', $current_folder->id)->get();
        $tasks = $current_image->tasks()->orderBy('due_day', 'asc')->paginate(5);
        
        // タスク一覧ビューでそれを表示
        return view('tasks/index', [
            'images' => $image,
            'current_image_id' => $current_image->id,
            'tasks' => $tasks,
            'picture_id' => $current_image,
        ]);
    }
    
    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create($id, CreateTasks $request)
    {
        $current_image = UploadImage::find($id);
        $task = new Task();
        $task->title = $request->title;
        $task->content = $request->content;
        $task->due_day = $request->due_day;
    
        // preg_match_allを使用して#タグのついた文字列を取得している
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);
        $tags = [];
        // $matchの中でも#が付いていない方を使用する(配列番号で言うと1)
        foreach($match[1] as $tag) {
           // firstOrCreateで重複を防ぎながらタグを作成している。
           $record = Tag::firstOrCreate(['name' => $tag]);
           array_push($tags, $record);
        }

        $tags_id = [];
        foreach($tags as $tag) {
           array_push($tags_id, $tag->id);
       }
        
        
        $current_image->tasks()->save($task);
    
        $task->tags()->attach($tags_id);
        return redirect()->route('tasks.index', [
            'id' => $current_image->id,
            ]);
    }
    
    // getでmessages/idにアクセスされた場合の「取得表示処理」
    public function showCreateForm($id)
    {
        $image = UploadImage::find($id);
        return view('tasks.create', [
            'image' => $image,
            'image_id' => $id
        ]);
    }
    
    public function showEditForm($id, $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }
    
    public function edit($id,$task_id, EditTasks $request)
    {
        // タスクのIDを取得
        $task = Task::find($task_id);
        //タスクを編集　タスクモデルのfillable
        $task->fill($request->all());
        $task->save();
    
        return redirect()->route('tasks.index', [
            'id' => $task->upload_image_id,
        ]);
    }
    
    public function statusedit($id)
    {
        //画像ごとのタスクを一括更新
        Task::where('upload_image_id',$id)->update(['status' => '3']);
        //タスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $id,
        ]);
    }
    
    public function destroy($id,$task_id){
		$deletetask = Task::find($task_id);
		$redirect_task = Task::find($task_id);
		$deletetask->delete();
		return redirect()->route('tasks.index', [
            'id' => $redirect_task->upload_image_id,
        ]);
	}
}