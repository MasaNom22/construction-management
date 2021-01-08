<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index() {
      $users = User::where('role','member')->paginate(1);
      return view('users.index',['users' => $users]);
    }
}
