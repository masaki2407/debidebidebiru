<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>詳細画面</h1>
        <div>
            <p>タイトル：{{ $post->title }}</p>
            <p>本文：{{ $post->body }}</p>
            <p>カテゴリー：<a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></p>
        </div>
        
        
        <? //コメント機能ここから?>
        @foreach ($comments as $comment)
            <div style='border:solid 1px; margin-bottom: 10px;'>
                <p>
                    ユーザーネーム：{{$comment->user->name}}
                    コメント：{{ $comment->comment }}
                </p>
            </div>
        @endforeach
        <form action="/posts/comment" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}"/> 
            <input type="text" name="comment" placeholder="コメントを入力してください！" value="{{ old('comment')}}"/>
            <input type="submit" value="保存"/>
        </form>
            
        <?//コメント機能ここまで?>
        
        <div>
            <p class="edit">[<a href="/posts/{{ $post->id }}/edit">編集</a>]</p>
            <a href="/">戻る</a>
        </div>
    </body>
</html>
