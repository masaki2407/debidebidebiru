<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use Cloudinary;  
use App\Models\Comment;
use App\Models\Place;
use App\Models\Image;

class PostController extends Controller
{
    public function index(Post $post, Place $place)
    {
        $place_search = $request['place'];

        $query = Post::query();

        if($place_search != null) {
            $query->where('place_id', 'LIKE', "{$place_search}");
        }

        $posts = $query->get();
        return view('posts.index')->with(['posts' => $posts, 'places'=>$place->get()]);
    }
    

    public function show(Post $post, Comment $comment)
    {
        return view('posts/show')->with(['post' => $post, 'comments' => $comment->get()]);
    }

    public function create(Place $place)
    {
        return view('posts/create')->with(['places' => $place->get()]);
    }

    public function store(Post $post, Request $request, Image $image)
    {
        
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
         //画像のURLを画面に表示
        
        $input = $request['post'];
        $post->fill($input)->save();
        
        $tmps=$request->files;
        foreach($tmps as $tmp){
            foreach($tmp as $img){
                $post_image=new Image();
                $image_url = Cloudinary::upload($img->getRealPath())->getSecurePath();
                $post_image->post_id=$post->id;
                $post_image->image=$image_url;
                $post_image->save();
                // $images = ["image" => $image_url];
                // $images += ["post_id" => $post->id];
                // $image->fill($images)->save();
            }
        }

        return redirect('/posts/' . $post->id);
        
    }

    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();

        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }

}
