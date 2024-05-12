<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Guestmessage;
use App\Models\Popularpost;
use App\Models\Post;
use App\Models\subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('disable.cache');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $post = Post::count();
        $user = User::count();
        $subscriber = subscribe::count();
        $guest_message = Guestmessage::count();
        $author_ids = Post::groupBy('author_id')
            ->selectRaw('author_id, count(*) as count')
            ->orderByDesc('count')
            ->pluck('author_id')
            ->toArray();
        $top_authors = collect();
        foreach($author_ids as $author_id){
           $author = User::where('id', $author_id)->get();
           $top_authors = $top_authors->merge($author);
        }
        $post_count = Post::where('author_id', Auth::id())->count();

        $post_ids = Post::where('author_id', Auth::id())->pluck('id');
        $popular_posts = Popularpost::whereIn('post_id', $post_ids)->get();
        $total_views = 0;
        foreach ($popular_posts as $post1) {
            $total_views += $post1['total_view'];
        }
        $comment = Comment::whereIn('post_id', $post_ids)->count();
        $top_posts = Post::where('author_id', Auth::id())->latest()->get();

        return view('dashboard', [
            'user'=>$user,
            'post'=>$post,
            'subscriber'=>$subscriber,
            'guest_message'=>$guest_message,
            'top_authors'=>$top_authors,
            'post_count'=>$post_count,
            'total_views'=>$total_views,
            'comment'=>$comment,
            'top_posts'=>$top_posts,
        ]);
    }

    function logout(Request $request){
        Auth::logout();
        // $request->session()->flush();
        // $request->session()->regenerateToken();
        return redirect()->route('login');
    
    }
}
