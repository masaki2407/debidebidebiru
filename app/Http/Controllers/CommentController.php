<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post, Comment $comment)
    {
        
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            ]);
            
        return back()->with(['post' => $post, 'comments' => $comment->get()]);
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