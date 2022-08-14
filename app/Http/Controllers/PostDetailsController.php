<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostDetailsController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(12);
        return view('allPosts',compact('posts'));
    }

    public function details($slug)
    {
       $posts = Post::where('slug',$slug)->first();
       $blogKey = 'blog_'.$posts->id;
       if (!Session::has($blogKey)) {
        $posts->increment('view_count');
        Session::put($blogKey,1);
    }
        $randomPosts = Post::all()->random(3);
        return view('postDetails',compact('posts','randomPosts'));
    }

    public function postByCategory($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $posts = Category::where('slug',$slug)->first()->posts()->paginate(12);
        return view('categoryPosts',compact('posts','category'));
    }

    public function postByTag($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        $posts = Tag::where('slug',$slug)->first()->posts()->paginate(12);
        return view('tagPosts',compact('posts','tag'));
    }
}
