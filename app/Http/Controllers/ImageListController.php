<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UploadImage;

use Illuminate\Support\Facades\Storage;

class ImageListController extends Controller
{
    function show(){
    	if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
		//アップロードした画像を取得
		$uploads = $user->uploadimages()->orderBy("id", "desc")->get();
		// $uploads = UploadImage::orderBy("id", "desc")->get();
		return view("image_list",[
			"images" => $uploads
		]);
    	}
	}
	
	function destroy($id){
		$deletePictures = UploadImage::find($id);
		$deleteName = $deletePictures->file_path;
		Storage::disk('s3')->delete($deleteName);
		$deletePictures->delete();
		return redirect("/list");
	}
}
