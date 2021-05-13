<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UploadImage;
use Storage;

class UploadImageController extends Controller
{
    public function show()
    {
        return view("upload_form");
    }
    
    public function showEditForm($id)
    {
        $image = UploadImage::find($id);

        return view('image_edit', [
            'image' => $image,
        ]);
    }
    
    public function edit($id, Request $request)
    {
        $image = UploadImage::find($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $image->title = $request->title;
        $image->content = $request->content;
        $image->save();
        
        // session()->flash('flash_message', '変更が完了しました');
        return redirect()->route('image_list');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:png,jpeg',
            'title' => 'required',
            'content' => 'required'
        ]);
        $upload_image = $request->file('image');
        $title = $request->input('title');
        $content = $request->input('content');

        if($upload_image) {
        	//アップロードされた画像を保存する
        	$path = $upload_image->store('uploads',"public");
        	//画像の保存に成功したらDBに記録する
        	if($path){
        		// UploadImage::create([
        		$request->user()->uploadimages()->create([
        			"file_name" => $upload_image->getClientOriginalName(),
        			"title" => $title,
        			"content" => $content,
        			"file_path" => $path
        		]);
        	}
        }
        
        // if ($upload_image) {
        //     $path = Storage::disk('s3')->putFile('/', $upload_image, 'public');
            // ファイル名を指定する場合はputFileAsを利用する
            // $path = Storage::disk('s3')->putFileAs('/', $file, '.jpg', 'public');
            // if ($path) {
                // UploadImage::create([
            //     $request->user()->uploadimages()->create([
            //         "file_name" => $upload_image->getClientOriginalName(),
            //         "title" => $title,
            //         "content" => $content,
            //         "file_path" => $path
            //     ]);
            // }
        // }
        return redirect("/list");
    }
}
