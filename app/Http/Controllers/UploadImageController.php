<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageEdit;
use App\Http\Requests\UploadImageUpload;
use App\UploadImage;
use Illuminate\Support\Facades\DB;

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

    public function edit($id, UploadImageEdit $request)
    {
        $image = UploadImage::find($id);

        $image->title = $request->title;
        $image->content = $request->content;
        $image->save();

        // session()->flash('flash_message', '変更が完了しました');
        return redirect()->route('image_list');
    }

    public function upload(UploadImageUpload $request)
    {

        $upload_image = $request->file('image');
        $title = $request->input('title');
        $content = $request->input('content');
        DB::beginTransaction();
        if ($upload_image) {
            //アップロードされた画像を保存する
            $path = $upload_image->store('uploads', "public");
            //画像の保存に成功したらDBに記録する
            try {
                if ($path) {
                    // UploadImage::create([
                    $request->user()->uploadimages()->create([
                        "file_name" => $upload_image->getClientOriginalName(),
                        "title" => $title,
                        "content" => $content,
                        "file_path" => $path,
                    ]);
                }
                DB::commit();
            } catch (Exception $exception) {
                DB::rollBack();
            }
        }

        return redirect()->route('image_list');
    }
}
