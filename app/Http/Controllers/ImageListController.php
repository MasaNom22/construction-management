<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UploadImage;

use Illuminate\Support\Facades\Storage;

class ImageListController extends Controller
{
    function show(){
		//アップロードした画像を取得
		$uploads = UploadImage::orderBy("id", "desc")->get();

		return view("image_list",[
			"images" => $uploads
		]);
	}
	
	function destroy($id){
		$deletePictures = UploadImage::find($id);
		$deleteName = $deletePictures->file_path;
		Storage::delete('public/' . $deleteName);
		$deletePictures->delete();
		return redirect("/list");
	}
}
