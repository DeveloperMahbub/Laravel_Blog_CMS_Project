<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.comments',compact('comments'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();
        Toastr::success('Comment Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
