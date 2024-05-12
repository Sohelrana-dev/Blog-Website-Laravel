<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    function category_list(){
        $categories = Category::paginate(5);
        return view('backend.category.category_list', [
            'categories'=>$categories,
        ]);
    }

    function category_store(Request $request){
        $request->validate([
            'name'=>'required|unique:categories',
            'image'=>'required|image|mimes:png,jpg,jpeg',
        ]);

        $image = $request->file('image');
        $extension = $image->extension();
        $file_name = str::lower(str_replace(' ', '-', $request->name)).'-'.random_int(10000000, 999999999).'.'.$extension;
        image::make($image)->save(public_path('uploads/category/'.$file_name));

        Category::insert([
            'name'=>$request->name,
            'image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        
        return back()->with('category_suc', 'Category Insert Successful!');
    }

    function category_delete($category_id){
        $category = Category::find($category_id);
        $category->delete();
        return back()->with('cat_del_suc', 'Category Delete Successful!');
    }

    function category_edit($category_id){
        $category = Category::find($category_id);
        return view('backend.category.category_edit', [
            'category'=>$category,
        ]);
    }

    function category_update(Request $request, $category_id){
        $category = Category::find($category_id);

        if($request->image == ''){
            $category->update([
                'name'=>$request->name,
            ]);
            return back()->with('cat_up_suc', 'Category Update Successful');
        }
        else{
            $image_location = public_path('uploads/category/'.$category->image);
            unlink($image_location);

            $image = $request->file('image');
            $extension = $image->extension();
            $file_name = str::lower(str_replace(' ', '-', $request->name)).'-'.random_int(10000000, 999999999).'.'.$extension;
            image::make($image)->save(public_path('uploads/category/'.$file_name));

            $category->update([
                'name'=>$request->name,
                'image'=>$file_name,
             ]);

            return back()->with('cat_up_suc', 'Category Update Successful');

        }
  
    } 

    function category_trash_list(){
        $trash_category = Category::onlyTrashed()->get();
        return view('backend.category.category_trash_list', [
            'trash_category'=>$trash_category,
        ]);
    }

    function category_trash_delete($category_id){

        Post::where('category_id', $category_id)->update([
            'category_id'=> 14,
        ]);

        $category = Category::onlyTrashed()->find($category_id);
        $image_location = public_path('uploads/category/'.$category->image);
        unlink($image_location);
        $category->forceDelete();
        return back()->with('cat_del_succ', 'Category Delete Successful!');
    }

    function category_trash_restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->with('cat_restore_succ', 'Category Restore Successful!');
    }
}