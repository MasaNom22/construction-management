<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
  {
    public function index(Request $request) {
    //名前受け取り
    $keyword = $request->input('name');
   
    $users = User::where('role','member')->paginate(5);
    //もし検索欄に名前があったら
    if(!empty($keyword))
    {
      $users= User::where('name','like','%'.$keyword.'%')->where('role','member')->paginate(5);
    }
  
      return view('users.index',['users' => $users]);
  }
  
  public function destroy($id,Request $request)
  {
		$deleteuser = User::find($id);
		$deleteuser->delete();
		$users = User::where('role','member')->paginate(5);
		return redirect()->route('users.index',['users' => $users]);
	}
	
	public function showEditForm($id)
  {
      $user = User::find($id);

      return view('users/edit', [
          'user' => $user,
      ]);
  }
    
  public function edit($id, Request $request)
  {
      //ユーザーを特定
      $user = User::find($id);
      //ユーザーの上書き
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();
        
      return redirect()->route('users.index', [
          'id' => $user->id,
      ]);
  }
}
