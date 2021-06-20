<?php

namespace App\Http\Controllers;

use App\UploadImage;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageListController extends Controller
{
    public function show()
    {

        $user = User::first();

        $images = $user->uploadimages()->orderBy("id", "desc")->get();

        return view("image_list", [
            "images" => $images,
        ]);
    }

    public function destroy($id)
    {
        $delete_picture = UploadImage::find($id);
        $delete_name = $delete_picture->file_path;

        DB::beginTransaction();
        $delete_picture->delete();
        try {
            Storage::delete('public/' . $delete_name);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return redirect("/list");
    }
}
