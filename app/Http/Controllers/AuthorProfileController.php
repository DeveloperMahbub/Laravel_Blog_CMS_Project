<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorProfileController extends Controller
{
    public function profile($username)
    {
        $author = User::where('username',$username)->first();
        $posts = $author->posts()->approved()->published()->paginate(10);
        return view('profile',compact('author','posts'));
    }
}
