<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        //名前受け取り
        $keyword = $request->input('name');

        $users = User::where('role', 'member')->paginate(5);
        //もし検索欄が空でない時
        if (!empty($keyword)) {
            $users = User::where('name', 'like', '%' . $keyword . '%')->where('role', 'member')->paginate(5);
        }

        return view('users.index', ['users' => $users]);
    }

    public function destroy($id, Request $request)
    {
        $delete_user = User::find($id);
        DB::beginTransaction();
        $delete_user->delete();
        try {
            $users = User::where('role', 'member')->paginate(5);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        return redirect()->route('users.index', ['users' => $users]);
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

    public function download_csv(Request $request)
    {
        return response()->streamDownload(
            function () {
                // 出力バッファをopen
                $stream = fopen('php://output', 'w');
                // 文字コードをShift-JISに変換
                stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
                // ヘッダー
                fputcsv($stream, [
                    'name',
                    'email',
                ]);
                // データ
                foreach (User::where('role', 'member')->cursor() as $user) {
                    fputcsv($stream, [
                        $user->name,
                        $user->email,
                    ]);
                }
                fclose($stream);
            },
            '下請業者一覧.csv',
            [
                'Content-Type' => 'application/octet-stream',
            ]
        );
    }
}
