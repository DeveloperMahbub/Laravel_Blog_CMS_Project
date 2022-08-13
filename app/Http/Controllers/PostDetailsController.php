<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostDetailsController extends Controller
{
    public function details($slug)
    {
       $posts = Post::where('slug',$slug)->first();
        $randomPosts = Post::all()->random(3);
        return view('postDetails',compact('posts','randomPosts'));
    }
}
