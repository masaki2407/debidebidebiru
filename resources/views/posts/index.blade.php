<x-app-layout>
        
        
        <?//検索機能ここから?>
        <div>
          <form action="{{ route('post.index') }}" method="GET">
            <select name="place">
                @foreach($places as $place)
                    <option value="{{ $place->id }}">{{ $place->name }}</option>
                @endforeach
            </select>
            <input type="submit" value="検索">
          </form>
        </div>
        <?//検索機能ここまで?>
        
        <h2>投稿一覧画面</h2>
        <a href='/posts/create'>新規投稿</a>
        <div>
            @foreach ($posts as $post)
                <div style='border:solid 1px; margin-bottom: 10px;'>
                    <p>
                        タイトル：<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </p>
                    <p>カテゴリー：<a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></p>
                </div>
            @endforeach
        </div>
        <div>
            {{ $posts->links() }}
        </div>
</x-app-layout>