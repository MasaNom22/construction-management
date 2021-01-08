<?php

namespace App\Http\Components;

use App\User;

class Serch
{
  public static function serch($keyword_name)
  {
          $query = User::query();
          if(!empty($keyword_name)) {
          $users = $query->where('name','like', '%' .$keyword_name. '%')->get();
          $message = "「". $keyword_name."」を含む名前の検索が完了しました。";
        }

        
        else {
          $users = null;
          $message = "検索結果はありません。";
        }

        return  [$users,$message];
}

}