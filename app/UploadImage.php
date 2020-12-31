<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UploadImage extends Model
{

    //upload_imageテーブルと連携する
    protected $table = "upload_images";
    //後にcreate()メソッドで保存するカラムを指定
    protected $fillable = [
        'file_name', 'file_path',
    ];
}
