<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>チーム開発会へようこそ！</h1>
        <h2>投稿作成</h2>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <h2>店名</h2>
                <input type="text" name="post[market_name]" placeholder="タイトル" value="{{ old('post.market_name') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.market_name') }}</p>
            </div>
            <div>
                <h2>場所</h2>
                <select name="post[place_id]">
                    @foreach($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <h2>住所</h2>
                <textarea name="post[address]" placeholder="今日も1日お疲れさまでした。">{{ old('post.address') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.address') }}</p>
            </div>
            <div>
                <h2>アクセス</h2>
                <textarea name="post[access]" placeholder="今日も1日お疲れさまでした。">{{ old('post.access') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.access') }}</p>
            </div>
            <div>
                <h2>営業時間</h2>
                <textarea name="post[opening_hours]" placeholder="今日も1日お疲れさまでした。">{{ old('post.opening_hours') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.opening_hours') }}</p>
            </div>
            <div>
                <h2>ユーザーからのコメント</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="image">
                <input name="files[]" type="file" onchange="elementClone()" multiple>
            </div>
            <input type="hidden" name="post[user_id]" value="{{Auth::user()->id }}">
            <input type="hidden" name="post[prefecture_id]" value="1">
            <input type="submit" value="保存"/>
        </form>
        <div><a href="/">戻る</a></div>
        <script>
            function elementClone() {
                let cloneObj = $($('input[name="files[]"]')[0]).clone();
                cloneObj.attr('name', `files[]`);
                cloneObj.appendTo('#xx');
            }
        </script>
    </body>
</html>
