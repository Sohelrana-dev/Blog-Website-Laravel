<?php

namespace App\Http\Controllers;

use App\Models\Admindesp;
use App\Models\Adminicon;
use App\Models\Auth_desp;
use App\Models\AuthIcon;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Logo;
use App\Models\Popularpost;
use App\Models\Post;
use App\Models\tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FrontendController extends Controller
{
    function index(){
        $category_count = Post::groupBy('category_id')
            ->selectRaw('category_id, count(*) as count')
            ->orderByDesc('count')
            ->first();

        $popular_posts = Popularpost::groupBy('post_id')
            ->selectRaw('sum(total_view) as sum, post_id')
            ->orderByDesc('sum')
            ->get();
        $lastWeekDate = Carbon::now()->subDays(30);
        $trending_ids = Popularpost::where('created_at', '>=', $lastWeekDate)
            ->groupBy('post_id')
            ->selectRaw('sum(total_view) as sum, post_id')
            ->orderByDesc('sum')
            ->pluck('post_id')
            ->toArray();
        
        $trending_posts = collect();
        foreach($trending_ids as $trending_id){
           $posts = Post::where('id', $trending_id)->get();
           $trending_posts = $trending_posts->merge($posts);
        }

        $trending_post2 = $trending_posts->skip(1);
        $trending_post3 = $trending_posts->skip(3);
        $trending_post4 = $trending_posts->skip(4);

        $category_highest = $category_count->category_id;
        $banner_posts = Post::where('category_id', $category_highest)->latest()->get();
        $banner_post2 = $banner_posts->skip(1);
        $all_posts = Post::latest()->get();
        $single_categories = Category::find($category_highest);
        $category_name = $single_categories->name;
        $editor_post = Post::whereNotNull('updated_at')->latest()->get();          
        $editor_post2 = $editor_post->skip(1);
        $categories = Category::all();
        $tags = tag::all();
        $admin_desps = Admindesp::all();
        $admin_icons = Adminicon::all();
        return view('frontend.index', [
            'banner_posts'=>$banner_posts,
            'all_posts'=>$all_posts,
            'editor_post'=>$editor_post,
            'categories'=>$categories,
            'tags'=>$tags,
            'category_name'=>$category_name,
            'editor_post2'=>$editor_post2,
            'banner_post2'=>$banner_post2,
            'admin_desps'=>$admin_desps,
            'admin_icons'=>$admin_icons,
            'popular_posts'=>$popular_posts,
            'trending_posts'=>$trending_posts,
            'trending_post2'=>$trending_post2,
            'trending_post3'=>$trending_post3,
            'trending_post4'=>$trending_post4,
        ]);
    }

    function category_post($category_id){
        $popular_posts = Popularpost::groupBy('post_id')
            ->selectRaw('sum(total_view) as sum, post_id')
            ->orderByDesc('sum')
            ->get();
        $posts = Post::where('category_id', $category_id)->paginate(2);
        $category_name = Category::find($category_id);
        $categories = Category::all();
        return view('frontend.category_post', [
            'category_name'=>$category_name,
            'posts'=>$posts,
            'categories'=>$categories,
            'popular_posts'=>$popular_posts,
        ]);
    }

    function single_blog($slug){

        $single_posts = Post::where('slug',$slug)->first();

        if(Popularpost::where('post_id', $single_posts->id)->exists()){
            Popularpost::where('post_id', $single_posts->id)->increment('total_view', 1);
        }
        else{
            Popularpost::insert([
                'post_id'=>$single_posts->id,
                'total_view'=>1,
                'created_at'=>Carbon::now(),
            ]);   
        }

        $popular_posts = Popularpost::groupBy('post_id')
            ->selectRaw('sum(total_view) as sum, post_id')
            ->orderByDesc('sum')
            ->get();
        $author_desp = Auth_desp::where('author_id', $single_posts->author_id)->first();
        $author_social_icons = AuthIcon::where('author_id', $single_posts->author_id)->get();
        $admin_desp = Admindesp::all();
        $admin_icons = Adminicon::all();
        $categories = Category::all();
        $category_count = Post::groupBy('category_id')
            ->selectRaw('category_id, count(*) as count')
            ->orderByDesc('count')
            ->first();
        $category_highest = $category_count->category_id;
        $banner_posts = Post::where('category_id', $category_highest)->latest()->get();
        $single_categories = Category::find($category_highest);
        $category_name = $single_categories->name;
        $tags = tag::all();
        $comments = Comment::with('replies')->where('post_id', $single_posts->id)->whereNull('parent_id')->latest()->get();
        return view('frontend.blog_single', [
            'single_posts'=>$single_posts,
            'author_desp'=>$author_desp,
            'author_social_icons'=>$author_social_icons,
            'admin_desp'=>$admin_desp,
            'admin_icons'=>$admin_icons,
            'categories'=>$categories,
            'banner_posts'=>$banner_posts,
            'category_name'=>$category_name,
            'tags'=>$tags,
            'comments'=>$comments,
            'popular_posts'=>$popular_posts,
        ]);
    }

    function author($author_id){
        $author_icons = AuthIcon::where('author_id', $author_id)->get();
        $author_desp = Auth_desp::where('author_id', $author_id)->first();
        $users = User::find($author_id);
        $author_posts1 = Post::where('author_id', $author_id)->get();
        $author_posts2 = Post::where('author_id', $author_id)->paginate(4);
        $categories = Category::all();
        return view('frontend.author2', [
            'users'=>$users,
            'author_icons'=>$author_icons,
            'author_desp'=>$author_desp,
            'author_posts1'=>$author_posts1,
            'author_posts2'=>$author_posts2,
            'categories'=>$categories,
        ]);
    }

    function all_post(Request $request){
        $popular_posts = Popularpost::groupBy('post_id')
            ->selectRaw('sum(total_view) as sum, post_id')
            ->orderByDesc('sum')
            ->get();
        $data = $request->search_input;
        $all_posts = Post::where(function ($q) use ($data){
            if(!empty($data) && $data != '' && $data != 'undefined'){
                $q->where('title', 'like', '%'.$data.'%');
                $q->orWhere('short_desp', 'like', '%'.$data.'%');
                $q->orWhere('blog_desp', 'like', '%'.$data.'%');
                $q->orWhere('summery_title', 'like', '%'.$data.'%');
                $q->orWhere('sum_desp', 'like', '%'.$data.'%');
            }
        })->paginate(6);
        $categories = Category::all();
        $tags = tag::all();
        return view('frontend.all_post', [
            'all_posts'=>$all_posts,
            'categories'=>$categories,
            'popular_posts'=>$popular_posts,
            'tags'=>$tags,
        ]);
    }

    function all_post_sec(){
        $posts = Post::latest()->get();
        $posts2 = Post::latest()->paginate(4);
        $admin_desp = Admindesp::all();
        $admin_icons = Adminicon::all();
        $categories = Category::all();
        $tags = tag::all();
        return view('frontend.all_post_sec', [
            'posts'=>$posts,
            'posts2'=>$posts2,
            'admin_desp'=>$admin_desp,
            'admin_icons'=>$admin_icons,
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }

    function contact(){
        $contacts = Contact::latest()->take(1)->get();
        return view('frontend.contact', [
            'contacts'=>$contacts,
        ]);
    }

    function tag_details($tag_id){
        $tags = tag::find($tag_id);
        $postIds = [];
        foreach(Post::all() as $post){
            $explode = explode(',',$post->tag);
            if(in_array($tag_id, $explode)){
                $postIds[] = $post->id;
            }
        }
        
        $posts = Post::whereIn('id', $postIds)->paginate(2);
        $popular_posts = Popularpost::groupBy('post_id')
            ->selectRaw('sum(total_view) as sum, post_id')
            ->orderByDesc('sum')
            ->get();
        $categories = Category::all();
        return view('frontend.tag_details', [
            'posts' => $posts,
            'tags' => $tags,
            'popular_posts' => $popular_posts,
            'categories' => $categories,
        ]);
    }
}
