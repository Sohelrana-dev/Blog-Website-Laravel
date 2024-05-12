<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    function add_post(){
        $categories = Category::all(); 
        $tags = tag::all();
        return view('backend.post.add_post', [
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }

    function post_store(Request $request){
        $request->validate([
            'category_id'=>'required',
            'title'=>'required',
            'short_desp'=>'required',
            'blog_desp'=>'required',
            'tag_id'=>'required',
            'blog_image'=>'required',
        ]);

        $blog_image = $request->blog_image;
        $extension = $blog_image->extension();
        $clean_title = preg_replace('/[^A-Za-z0-9\- ]/', '', $request->title);
        $file_name = str_replace(' ', '_', str::lower($clean_title)).'.'.$extension;
        image::make($blog_image)->save(public_path('uploads/blog/'.$file_name));
        
        $after_implod = implode(',', $request->tag_id);
        $slug = str_replace(' ', '_', str::lower(substr($clean_title, 1, 30)));
        Post::insert([
            'author_id'=>Auth::id(),
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'short_desp'=>$request->short_desp,
            'blog_desp'=>$request->blog_desp,
            'summery_title'=>$request->summery_title,
            'sum_desp'=>$request->sum_desp,
            'tag'=>$after_implod,
            'blog_image'=>$file_name,
            'slug'=>$slug,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('post_suc', 'Post Added Successful');
    }

    function post_list(){
        $posts = Post::where('author_id', Auth()->user()->id)->get();
        return view('backend.post.post_list', [
            'posts'=>$posts,
        ]);
    }

    function post_show($post_id){
        $post = Post::find($post_id);
        return view('backend.post.post_show',[
            'post'=>$post,
        ]);
    }

    function post_edit($post_id){
        $post = Post::find($post_id);
        $categories = Category::all();
        $tags = tag::all();
        return view('backend.post.post_edit', [
            'categories'=>$categories,
            'tags'=>$tags,
            'post'=>$post,
        ]);
    }

    function post_update(Request $request, $post_id){
         $request->validate([
            'category_id'=>'required',
            'title'=>'required',
            'short_desp'=>'required',
            'blog_desp'=>'required',
            'tag_id'=>'required',
        ]);
        $after_implod = implode(',', $request->tag_id);

        if($request->blog_image){
            $image_location = public_path('uploads/blog/'.Post::find($post_id)->blog_image);
            unlink($image_location);

            $blog_image = $request->blog_image;
            $extension = $blog_image->extension();
            $cleaned_product_name = preg_replace('/[^A-Za-z0-9\- ]/', '', $request->title);
            $file_name = str_replace(' ', '_', str::lower($cleaned_product_name)).'.'.$extension;
            image::make($blog_image)->save(public_path('uploads/blog/'.$file_name));

            Post::find($post_id)->update([
                'category_id'=>$request->category_id,
                'title'=>$request->title,
                'short_desp'=>$request->short_desp,
                'blog_desp'=>$request->blog_desp,
                'summery_title'=>$request->summery_title,
                'sum_desp'=>$request->sum_desp,
                'tag'=>$after_implod,
                'blog_image'=>$file_name,
            ]);
            return back()->with('post_up_suc', 'Post Update Successful');
        }
        else{
            Post::find($post_id)->update([
                'category_id'=>$request->category_id,
                'title'=>$request->title,
                'short_desp'=>$request->short_desp,
                'blog_desp'=>$request->blog_desp,
                'summery_title'=>$request->summery_title,
                'sum_desp'=>$request->sum_desp,
                'tag'=>$after_implod,
            ]);
            return back()->with('post_up_suc', 'Post Update Successful');
        }
    }

    function post_delete($post_id){
        $post = Post::find($post_id);
        $image_location = public_path('uploads/blog/'.$post->blog_image);
        unlink($image_location);

        $post->delete();
        return back()->with('post_delete', 'Post Delete Successful');
    }
}
