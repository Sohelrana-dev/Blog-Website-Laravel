<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function comment_store(Request $request, $id){
        $request->validate([
            'comment'=>'required',
        ]);
        $user = Auth::guard('guestlogin')->user();

            Comment::insert([
                'guest_id'=>$user->id,
                'post_id'=>$id,
                'comment'=>$request->comment,
                'parent_id'=>$request->parent_id,
                'created_at'=>Carbon::now(),
            ]);
        return back();
    }

    function comment_single(){
        $post_ids = Post::where('author_id', Auth::id())->pluck('id');
        $comments = Comment::with('replies')->whereIn('post_id', $post_ids)->paginate(10);
        return view('backend.comment.comment_single', [
            'comments'=>$comments,
        ]);
    }

    function comment_delete($comment_id){
        Comment::find($comment_id)->delete();
        return back()->with('comment_del', 'Comment Delete Successful');
    }

    function getnotifyComment(Request $request){
        Comment::find($request->comment_id)->update([
        'status'=>0,
       ]);
    }

    function comment_view($comment_id){
        $comment = Comment::find($comment_id);
        $comment->update([
            'status'=>0,
        ]);

        return view('backend.comment.comment_view', [
            'comment'=>$comment,
        ]);
    }

    function comment_read(){
        $comments = Comment::where('status', 1)->get();

        foreach($comments as $comment){
            $comment->update([
                'status'=>0,
            ]);
        }
        return back();
    }
}
