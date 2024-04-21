<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //バリデーションを行う
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'requird|string'
            ]);
            
        Comment::create([
            'post_id' => $reqest->post_id,
            'user_id' => $auth()->user()->id,
            'content' => $request->content,
            ]);
            
        return back()->with('success', 'コメント投稿完了');
    }
    
    public function destroy(Comment $comment)
    {
        //コメントの所有者がリクエストを送信したユーザーと一致するか確認する
        if($comment->user_id !== auth()->id())
        {
            return redirect()->back()->with('error', 'このコメントを削除する権限がありません。');
        }
        
        //コメント削除
        $comment->delete();
        
        return redirect()->back()->with('success', 'コメントが削除されました。');
    }
}