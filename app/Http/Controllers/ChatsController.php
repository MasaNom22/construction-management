<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $comments = Comment::get();
        return view('chats/index', ['comments' => $comments]);
    }
    
    public function add(Request $request)
    {
        $user = Auth::user();
        $comment="";
        $comment = $request->input('comment');
        Comment::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'comment' => $comment
        ]);
        return redirect()->route('chats.index');
    }

    public function getData()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $json = ["comments" => $comments];
        return response()->json($json);
    }
    
    public function destroy(){
		Comment::query()->delete();
		return redirect()->route('chats.index');
	}
}
